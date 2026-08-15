<?php

namespace App\Http\Controllers;

use App\Helpers\ApiClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiWarmupController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (ApiClient::isAwake()) {
            return response()->json(['status' => 'awake']);
        }

        ApiClient::ping();

        if ($request->boolean('wait')) {
            $ready = ApiClient::waitUntilAwake();

            return response()->json(
                ['status' => $ready ? 'ready' : 'unavailable'],
                $ready ? 200 : 503
            );
        }

        return response()->json(['status' => 'waking']);
    }
}
