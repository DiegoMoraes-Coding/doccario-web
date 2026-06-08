<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        if (AuthHelper::hasValidToken($request)) {
            return redirect()->route('home');
        }

        return view('landing');
    }
}
