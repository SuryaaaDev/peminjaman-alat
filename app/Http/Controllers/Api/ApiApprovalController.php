<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiApprovalController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['items'])
            ->where('status', 'request')
            ->get();

        $result = [];

        foreach ($borrows as $borrow) {
            $studentResponse = Http::get("http://localhost:8001/api/students/" . $borrow->student_id);

            $studentData = null;
            if ($studentResponse->successful()) {
                $studentJson = $studentResponse->json();
                $studentData = $studentJson['data'] ?? null;
            }

            $result[] = [
                'id' => $borrow->id,
                'status' => $borrow->status,
                'due_at' => $borrow->due_at,
                'notes' => $borrow->notes,
                'items' => $borrow->items,
                'student' => $studentData ? [
                    'id' => $studentData['id'],
                    'name' => $studentData['name'],
                    'class' => $studentData['class']['class_name'] ?? '-', // ambil nama kelas
                ] : null,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    public function approve($id)
    {
        $borrow = Borrow::with('items')->findOrFail($id);
        $borrow->status = 'returned';
        $borrow->returned_at = now();
        $borrow->save();

        foreach ($borrow->items as $item) {
            $item->available_quantity += $item->pivot->quantity;
            $item->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Return approved successfully.',
            'data' => $borrow
        ]);
    }

    public function reject($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->status = 'borrowed';
        $borrow->save();

        return response()->json([
            'success' => true,
            'message' => 'Return rejected successfully.',
            'data' => $borrow
        ]);
    }
}
