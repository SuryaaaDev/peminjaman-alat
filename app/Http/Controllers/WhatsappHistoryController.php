<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappHistoryController extends Controller
{
    private $apiUrl = 'http://localhost:8002/api/whatsapp-histories';
    
    public function index()
    {
        $response = Http::get($this->apiUrl);
        $histories = $response->json()['data'] ?? [];

        return view('whatsapp_histories.index', compact('histories'));
    }

    public function show($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");
        $history = $response->successful() ? $response->json() : null;

        return view('whatsapp_histories.show', compact('history'));
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('whatsapp_histories.index')
                ->with('success', 'History deleted successfully');
        }

        return redirect()->route('whatsapp_histories.index')
            ->with('error', 'Failed to delete history');
    }
}
