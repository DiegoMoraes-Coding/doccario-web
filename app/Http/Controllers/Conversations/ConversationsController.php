<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiClient;

class ConversationsController extends Controller
{
    public function show($conversationId)
    {
        $route = "/conversations/{$conversationId}";
        try {
            $response = ApiClient::request('GET', $route);
            if ($response->ok()) {
                return response()->json($response->json(), 200);
            } else {
                $error = $response->json();
                $errorMessage = $error['error'] ?? 'Failed to fetch conversation.';
                return response()->json(['error' => $errorMessage], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching conversation: ' . $e->getMessage()], 500);
        }
    }

    public function clean($conversationId)
    {
        $route = "/conversations/{$conversationId}/clean";
        try {
            $response = ApiClient::request('DELETE', $route);
            if ($response->ok()) {
                return response()->json(['success' => true], 200);
            } else {
                $error = $response->json();
                $errorMessage = $error['error'] ?? 'Failed to reset conversation.';
                return response()->json(['error' => $errorMessage], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error resetting conversation: ' . $e->getMessage()], 500);
        }
    }

    public function chat($conversationId = null)
    {
        $route = '/documents';
        $documentName = 'Document';
        $conversationData = null;
        $documents = [];
        $documentCount = 0;
        $maxDocumentsAllowed = 0;
        $usagePercentage = 0;

        try {
            $response = ApiClient::request('GET', $route);
            if ($response->ok()) {
                $data = $response->json();
                $documents = $data['documents'] ?? [];
                $documentCount = $data['count'] ?? 0;
                $maxDocumentsAllowed = $data['maxDocumentsAllowed'] ?? 0;
                $usagePercentage = $data['usagePercentage'] ?? 0;
            }

            if ($conversationId && !empty($documents)) {
                $document = collect($documents)->firstWhere('conversationId', $conversationId);
                if ($document) {
                    $documentName = $document['title'] ?? 'Document';
                }

                // Fetch conversation data including messages
                $conversationRoute = "/conversations/{$conversationId}";
                $conversationResponse = ApiClient::request('GET', $conversationRoute);
                $conversationData = $conversationResponse->ok() ? $conversationResponse->json() : null;
            } elseif (!empty($documents)) {
                $documentName = $documents[0]['title'] ?? 'Document';
            }
        } catch (\Exception $e) {
            $documents = [];
        }

        return view('chat', [
            'documents' => $documents,
            'documentName' => $documentName,
            'conversationId' => $conversationId,
            'conversationData' => $conversationData,
            'documentCount' => $documentCount,
            'maxDocumentsAllowed' => $maxDocumentsAllowed,
            'usagePercentage' => $usagePercentage,
        ]);
    }

    public function ask(Request $request, $conversationId)
    {
        $route = "/conversations/{$conversationId}/ask";

        $question = $request->input('question');
        if (!$question) {
            return response()->json(['error' => 'No question provided.'], 400);
        }

        try {
            ApiClient::request('GET', '/documents');

            $token = Session::get('token') ?? Cookie::get('doccario_token');
            $headers = [
                'Accept' => 'text/event-stream',
                'Content-Type' => 'application/json',
            ];
            if ($token) {
                $headers['Authorization'] = 'Bearer ' . $token;
            }

            $client = new \GuzzleHttp\Client([
                'stream' => true,
                'timeout' => 120,
            ]);

            $apiResponse = $client->post($apiUrl, [
                'headers' => $headers,
                'json' => ['question' => $question],
                'stream' => true,
            ]);

            return response()->stream(function () use ($apiResponse) {
                $body = $apiResponse->getBody();
                while (!$body->eof()) {
                    $chunk = $body->read(4096);
                    if ($chunk !== false && $chunk !== '') {
                        echo $chunk;
                        @ob_flush();
                        flush();
                    }
                }
            }, 200, [
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'X-Accel-Buffering' => 'no',
            ]);
        } catch (\Exception $e) {
            return response()->stream(function () use ($e) {
                echo "data: {\"error\":\"" . addslashes($e->getMessage()) . "\"}\n";
                echo "data: [DONE]\n";
                @ob_flush();
                flush();
            }, 200, [
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'X-Accel-Buffering' => 'no',
            ]);
        }
    }
}
