<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WhatsappHistory;
use Illuminate\Http\Request;

class ApiWhatsappHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = WhatsappHistory::with('user')->latest()->get();
        return response()->json([
            'data' => $histories,
            'message' => 'Whatsapp histories retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $history = WhatsappHistory::with('user')->findOrFail($id);
        return response()->json([
            'data' => $history,
            'message' => 'Whatsapp history retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $history = WhatsappHistory::findOrFail($id);
        $history->delete();
        return response()->json(['message' => 'History deleted successfully']);
    }
}
