<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\RFID;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RFIDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rfid = RFID::first();

        if ($rfid) {
            return response()->json([
                'success' => true,
                'data'    => $rfid,
                'message' => 'Data RFID successfully retrieved.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data RFID not found.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nokartu = $request->query('card_number');

        if (!$nokartu) {
            return response()->json([
                'success' => false,
                'message' => 'Card number is required.'
            ], 400);
        }

        RFID::truncate();

        $temp = RFID::create([
            'card_number' => $nokartu
        ]);

        return response()->json([
            'success' => true,
            'data'    => $temp,
            'message' => 'Card number successfully saved.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    private $apiBase = 'http://localhost:8001/api/students';

    public function findByCard(Request $request)
    {
        $cardNumber = RFID::first()?->card_number;

        if (!$cardNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Card number is required.'
            ], 400);
        }

        $response = Http::get($this->apiBase . '/card/' . $cardNumber);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch student data.'
            ], 500);
        }

        $raw = $response->json();
        $student = $raw['data'] ?? null;

        if (!$student || !isset($student['id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ]);
        }

        $borrow = Borrow::where('student_id', $student['id'])
            ->where('status', 'borrowed')
            ->first();

        if ($borrow) {
            $borrow->status = 'request';
            $borrow->save();

            RFID::truncate();

            return response()->json([
                'mode' => 'return',
                'message' => 'Student requests to return borrowed items.',
                'data' => $borrow->load('items')
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'          => $student['id'],
                'card_number' => $student['card_number'],
                'name'        => $student['name'],
                'class'       => $student['class']['class_name'] ?? '-',
            ]
        ]);
    }
}
