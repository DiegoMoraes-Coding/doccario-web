<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiClient;

class SignupController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $apiUrl = config('services.doccario_api.url') . '/auth/signup';
        $payload = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $response = ApiClient::request('POST', $apiUrl, $payload);

        if ($response->successful()) {
            return redirect()->route('login')
                ->with('success', 'Account created successfully! Please log in to your account.');
        }

        // Return API error message if available
        $apiError = $response->json();
        $errorMessage = $apiError['error'] ?? 'Signup failed. Please try again or use a different email.';
        return back()->with('error', $errorMessage)->withInput();
    }
}
