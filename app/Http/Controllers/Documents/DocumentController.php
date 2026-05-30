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
    public function chat($fileId = null)
    {
        $apiUrl = config('services.doccario_api.url') . '/documents';
        $documentName = 'Document';

        try {
            $response = ApiClient::request('GET', $apiUrl);
            $documents = $response->ok() ? $response->json() : [];

            if ($fileId && !empty($documents)) {
                $document = collect($documents)->firstWhere('id', $fileId);
                if ($document) {
                    $documentName = $document['name'] ?? 'Document';
                }
            } elseif (!empty($documents)) {
                $documentName = $documents[0]['name'] ?? 'Document';
            }
        } catch (\Exception $e) {
            $documents = [];
        }

        return view('chat', [
            'documents' => $documents,
            'documentName' => $documentName,
            'fileId' => $fileId,
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

            $response = $pending->post($apiUrl, [
                'file' => fopen($file->getPathname(), 'r'),
            ]);

            if ($response->ok()) {
                $data = $response->json();
                $fileId = $data['fileId'] ?? null;

                if ($fileId) {
                    return redirect()->route('chat', ['fileId' => $fileId])
                        ->with('success', 'Document uploaded successfully!');
                } else {
                    return back()->with('error', 'Upload failed: No file ID returned.');
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
