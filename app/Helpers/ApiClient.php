<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class ApiClient
{
    /**
     * Make an API request with automatic token refresh.
     *
     * @param string $method HTTP method (GET, POST, etc)
     * @param string $route API route, e.g. '/documents', '/conversations/{id}'
     * @param array $data Request data (optional)
     * @return \Illuminate\Http\Client\Response
     * @throws \Exception
     */
    public static function request(string $method, string $route, array $data = [])
    {
        $baseUrl = rtrim(config('services.doccario_api.url'), '/');
        $url = $baseUrl . (str_starts_with($route, '/') ? $route : ('/' . $route));

        $token = Session::get('token') ?? Cookie::get('doccario_token');
        $refreshToken = Session::get('refreshToken') ?? Cookie::get('doccario_refresh_token');

        $response = self::makeRequest($method, $url, $data, $token);

        if ($response->status() === 401 && $refreshToken) {
            $refreshUrl = $baseUrl . '/auth/refresh';
            $refreshResp = Http::asJson()->post($refreshUrl, ['refreshToken' => $refreshToken]);

            if ($refreshResp->ok()) {
                $refreshData = $refreshResp->json();
                Session::put('token', $refreshData['token']);
                Session::put('refreshToken', $refreshData['refreshToken']);
                Cookie::queue('doccario_token', $refreshData['token'], 60 * 24 * 30, null, null, true, true, false, 'Strict');
                Cookie::queue('doccario_refresh_token', $refreshData['refreshToken'], 60 * 24 * 30, null, null, true, true, false, 'Strict');

                $response = self::makeRequest($method, $url, $data, $refreshData['token']);
            } else {
                Session::forget(['token', 'refreshToken', 'user']);
                Cookie::queue(Cookie::forget('doccario_token'));
                Cookie::queue(Cookie::forget('doccario_refresh_token'));
                throw new \Exception('Session expired. Please log in again.');
            }
        }

        return $response;
    }

    private static function makeRequest(string $method, string $url, array $data, ?string $token)
    {
        $pending = Http::asJson();
        if ($token) {
            $pending = $pending->withToken($token);
        }
        $options = !empty($data) ? ['json' => $data] : [];
        return $pending->send($method, $url, $options);
    }
}
