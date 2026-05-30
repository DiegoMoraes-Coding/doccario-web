<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiClient;
use Illuminate\Support\Facades\Redirect;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $apiUrl = config('services.doccario_api.url') . '/documents';
        try {
            $response = ApiClient::request('GET', $apiUrl);
            $documents = $response->ok() ? $response->json() : [];
        } catch (\Exception $e) {
            $documents = [];
        }
        return view('home', [
            'documents' => $documents,
        ]);
    }
    public function chat(Request $request)
    {
        $apiUrl = config('services.doccario_api.url') . '/documents';
        try {
            $response = ApiClient::request('GET', $apiUrl);
            $documents = $response->ok() ? $response->json() : [];
        } catch (\Exception $e) {
            $documents = [];
        }
        return view('chat', [
            'documents' => $documents,
        ]);
    }
    public function destroy($id)
    {
        $apiUrl = config('services.doccario_api.url') . '/documents/' . $id;
        try {
            $response = ApiClient::request('DELETE', $apiUrl);
        } catch (\Exception $e) {
            // Optionally handle error
        }
        return redirect()->back();
    }
}
