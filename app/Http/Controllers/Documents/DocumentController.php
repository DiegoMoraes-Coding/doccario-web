<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $apiUrl = config('services.doccario_api.url') . '/documents/upload';
        $token = Session::get('token') ?? Cookie::get('doccario_token');

        try {
            $pending = Http::asMultipart();
            if ($token) {
                $pending = $pending->withToken($token);
            }

            $response = $pending
                ->attach('file', file_get_contents($file->getPathname()), $file->getClientOriginalName())
                ->post($apiUrl);

            if ($response->ok()) {
                $data = $response->json();
                $conversationId = $data['conversationId'] ?? null;

                if ($conversationId) {
                    return redirect()->route('chat', ['conversationId' => $conversationId])
                        ->with('success', 'Document uploaded successfully!');
                } else {
                    return back()->with('error', 'Upload failed: No conversation ID returned.');
                }
            } else {
                // Return API error message if available
                $apiError = $response->json();
                $errorMessage = $apiError['error'] ?? 'Upload failed. Please try again.';
                return back()->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Upload error: ' . $e->getMessage());
        }
    }
}
