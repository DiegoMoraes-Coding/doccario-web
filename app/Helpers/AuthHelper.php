<?php

namespace App\Helpers;

use Illuminate\Http\Request;

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
}
