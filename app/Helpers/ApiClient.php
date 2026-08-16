<?php

namespace App\Helpers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class ApiClient
{
    /**
     * Ping the API root to wake a sleeping Render instance (browser-like GET).
     */
    public static function ping(): bool
    {
        $baseUrl = self::baseUrl();

        if ($baseUrl === '') {
            return false;
        }

        self::wakeUp($baseUrl);

        return true;
    }

    /**
     * Quick check — returns true when the API is actually responding (not Render's 502/503 splash).
     */
    public static function isAwake(): bool
    {
        $baseUrl = self::baseUrl();

        if ($baseUrl === '') {
            return false;
        }

        $timeout = (int) config('services.doccario_api.awake_check_timeout_seconds', 3);
        $healthPath = (string) config('services.doccario_api.health_path', '');
        $url = $baseUrl . ($healthPath !== '' ? $healthPath : '');

        try {
            $response = Http::timeout($timeout)
                ->withHeaders(self::browserHeaders())
                ->get($url);

            return self::isReadyResponse($response);
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Ping and poll until the API responds or retries are exhausted.
     */
    public static function waitUntilAwake(): bool
    {
        $baseUrl = self::baseUrl();

        if ($baseUrl === '') {
            return false;
        }

        if (self::isAwake()) {
            return true;
        }

        $maxAttempts = (int) config('services.doccario_api.warmup_max_attempts', 15);
        $retrySeconds = (int) config('services.doccario_api.warmup_retry_seconds', 5);

        set_time_limit(($maxAttempts * $retrySeconds) + 60);

        self::wakeUp($baseUrl);

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            if (self::isAwake()) {
                return true;
            }

            if ($attempt < $maxAttempts) {
                sleep($retrySeconds);

                if ($attempt % 3 === 0) {
                    self::wakeUp($baseUrl);
                }
            }
        }

        return false;
    }

    /**
     * Make an API request with automatic token refresh and cold-start retries.
     *
     * @param string $method HTTP method (GET, POST, etc)
     * @param string $route API route, e.g. '/documents', '/conversations/{id}'
     * @param array $data Request data (optional)
     * @return \Illuminate\Http\Client\Response
     * @throws \Exception
     */
    public static function request(string $method, string $route, array $data = [])
    {
        $baseUrl = self::baseUrl();
        $url = $baseUrl . (str_starts_with($route, '/') ? $route : ('/' . $route));

        $token = Session::get('token') ?? Cookie::get('doccario_token');
        $refreshToken = Session::get('refreshToken') ?? Cookie::get('doccario_refresh_token');

        try {
            $response = self::requestWithRetry($method, $url, $data, $token);
        } catch (\Throwable) {
            abort(503, 'Our service is starting up. Please try again in a moment.');
        }

        if (self::shouldRetryResponse($response)) {
            abort(503, 'Our service is starting up. Please try again in a moment.');
        }

        if ($response->status() === 401 && $refreshToken) {
            $refreshUrl = $baseUrl . '/auth/refresh';

            try {
                $refreshResp = self::requestWithRetry('POST', $refreshUrl, ['refreshToken' => $refreshToken], null);
            } catch (\Throwable) {
                self::clearAuthState();
                abort(503, 'Our service is starting up. Please try again in a moment.');
            }

            if ($refreshResp->ok()) {
                $refreshData = $refreshResp->json();
                Session::put('token', $refreshData['token']);
                Session::put('refreshToken', $refreshData['refreshToken']);
                Cookie::queue('doccario_token', $refreshData['token'], 60 * 24 * 30, null, null, true, true, false, 'Strict');
                Cookie::queue('doccario_refresh_token', $refreshData['refreshToken'], 60 * 24 * 30, null, null, true, true, false, 'Strict');

                $response = self::requestWithRetry($method, $url, $data, $refreshData['token']);
            } else {
                self::clearAuthState();
                throw new \Exception('Session expired. Please log in again.');
            }
        }

        return $response;
    }

    private static function requestWithRetry(string $method, string $url, array $data, ?string $token): Response
    {
        $maxAttempts = (int) config('services.doccario_api.warmup_max_attempts', 15);
        $retrySeconds = (int) config('services.doccario_api.warmup_retry_seconds', 5);

        set_time_limit(($maxAttempts * $retrySeconds) + 60);

        self::wakeUp(self::baseUrl());

        $lastResponse = null;
        $lastException = null;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                $response = self::makeRequest($method, $url, $data, $token);

                if (! self::shouldRetryResponse($response)) {
                    return $response;
                }

                $lastResponse = $response;
            } catch (\Throwable $e) {
                if (! self::isConnectionError($e)) {
                    throw $e;
                }

                $lastException = $e;
            }

            if ($attempt === $maxAttempts) {
                break;
            }

            sleep($retrySeconds);

            if ($attempt % 3 === 0) {
                self::wakeUp(self::baseUrl());
            }
        }

        if ($lastResponse !== null) {
            return $lastResponse;
        }

        throw $lastException ?? new ConnectionException('Unable to reach the API.');
    }

    private static function isReadyResponse(Response $response): bool
    {
        $status = $response->status();

        // Render's cold-start proxy returns 502/503 before the app is actually up.
        return $status >= 200 && $status < 500;
    }

    private static function shouldRetryResponse(Response $response): bool
    {
        return in_array($response->status(), [502, 503, 504], true);
    }

    private static function wakeUp(string $baseUrl): void
    {
        $timeout = (int) config('services.doccario_api.warmup_timeout_seconds', 15);

        try {
            Http::timeout($timeout)
                ->withHeaders(self::browserHeaders())
                ->get($baseUrl);
        } catch (\Throwable) {
            // Expected while Render spins up — the request still triggers wake-up.
        }
    }

    private static function browserHeaders(): array
    {
        return [
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'User-Agent' => 'Mozilla/5.0 (compatible; DoccarioWeb/1.0; +https://doccario.com)',
        ];
    }

    private static function baseUrl(): string
    {
        return rtrim((string) config('services.doccario_api.url'), '/');
    }

    private static function isConnectionError(\Throwable $e): bool
    {
        if ($e instanceof ConnectionException) {
            return true;
        }

        $message = strtolower($e->getMessage());

        return str_contains($message, 'connection')
            || str_contains($message, 'timed out')
            || str_contains($message, 'could not resolve')
            || str_contains($message, 'failed to connect');
    }

    private static function clearAuthState(): void
    {
        Session::forget(['token', 'refreshToken', 'user']);
        Cookie::queue(Cookie::forget('doccario_token'));
        Cookie::queue(Cookie::forget('doccario_refresh_token'));
        Cookie::queue(Cookie::forget('doccario_user'));
    }

    private static function makeRequest(string $method, string $url, array $data, ?string $token): Response
    {
        $timeout = (int) config('services.doccario_api.request_timeout_seconds', 30);

        $pending = Http::timeout($timeout)->asJson();

        if ($token) {
            $pending = $pending->withToken($token);
        }

        $options = ! empty($data) ? ['json' => $data] : [];

        return $pending->send($method, $url, $options);
    }
}
