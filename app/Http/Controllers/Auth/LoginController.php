<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiClient;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $route = '/auth/login';
        $payload = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $response = ApiClient::request('POST', $route, $payload);

        if ($response->successful()) {
            $data = $response->json();
            $remember = $request->has('remember');
            if ($remember) {
                // Store token, refresh token and user in queued cookies for 30 days
                $minutes = 60 * 24 * 30;
                $path = '/';
                $domain = null;
                $secure = true;
                $httpOnly = true;
                $sameSite = 'Strict';

                Cookie::queue('doccario_token', $data['token'] ?? '', $minutes, $path, $domain, $secure, $httpOnly, false, $sameSite);
                Cookie::queue('doccario_refresh_token', $data['refreshToken'] ?? '', $minutes, $path, $domain, $secure, $httpOnly, false, $sameSite);
                Cookie::queue('doccario_user', json_encode($data['user'] ?? []), $minutes, $path, $domain, $secure, false, false, $sameSite);

                return redirect()->route('home')->with('success', 'Login successful!');
            } else {
                // Store in session only
                session([
                    'token' => $data['token'] ?? null,
                    'refreshToken' => $data['refreshToken'] ?? null,
                    'user' => $data['user'] ?? null,
                ]);
                return redirect()->route('home')->with('success', 'Login successful!');
            }
        }

        // Return API error message if available
        $apiError = $response->json();
        $errorMessage = $apiError['error'] ?? 'Invalid credentials or server error.';
        return back()->with('error', $errorMessage);
    }
}
