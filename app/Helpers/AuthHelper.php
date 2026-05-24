<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthHelper
{
    /**
     * Check if the user has a valid API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function hasValidToken(Request $request): bool
    {
        return (bool) ($request->session()->get('token') ?? $request->cookie('doccario_token'));
    }

    /**
     * Get the authenticated user from session or cookies.
     *
     * @return array|null
     */
    public static function getAuthenticatedUser(): ?array
    {
        // Try session first, then cookies
        $user = Session::get('user');

        if (!$user) {
            $userJson = Cookie::get('doccario_user');
            if ($userJson) {
                $user = json_decode($userJson, true);
            }
        }

        return $user;
    }
}
