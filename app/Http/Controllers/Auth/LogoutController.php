<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $forgetToken = cookie()->forget('doccario_token');
        $forgetRefresh = cookie()->forget('doccario_refresh_token');
        $forgetUser = cookie()->forget('doccario_user');
        return redirect('/login')
            ->with('success', 'Logged out successfully!')
            ->withCookie($forgetToken)
            ->withCookie($forgetRefresh)
            ->withCookie($forgetUser);
    }
}
