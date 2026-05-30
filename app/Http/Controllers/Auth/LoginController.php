<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiClient;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $apiUrl = config('services.doccario_api.url') . '/auth/login';
        $payload = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $response = ApiClient::request('POST', $apiUrl, $payload);

        if ($response->successful()) {
            $data = $response->json();
            $remember = $request->has('remember');
            if ($remember) {
                // Store token in a secure, httpOnly, SameSite=Strict cookie for 30 days
                $minutes = 60 * 24 * 30;
                $path = '/';
                $domain = null;
                $secure = true;
                $httpOnly = true;
                $sameSite = 'Strict';
                return redirect()->route('home')
                    ->with('success', 'Login successful!')
                    ->cookie('doccario_token', $data['token'] ?? '', $minutes, $path, $domain, $secure, $httpOnly, false, $sameSite)
                    ->cookie('doccario_refresh_token', $data['refreshToken'] ?? '', $minutes, $path, $domain, $secure, $httpOnly, false, $sameSite)
                    ->cookie('doccario_user', json_encode($data['user'] ?? []), $minutes, $path, $domain, $secure, false, false, $sameSite);
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

        return back()->with('error', 'Invalid credentials or server error.');
    }
}
