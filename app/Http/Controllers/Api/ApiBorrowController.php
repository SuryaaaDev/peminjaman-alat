<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\BorrowItem;
use App\Models\Item;
use App\Models\RFID;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Termwind\Components\Dd;

class ApiBorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with('items')->get();

        $students = [];
        try {
            $response = Http::get('http://localhost:8001/api/students');
            if ($response->successful()) {
                $students = collect($response->json()['data'] ?? []);
            }
        } catch (\Exception $e) {
            //
        }

        $borrows->transform(function ($borrow) use ($students) {
            $student = $students->firstWhere('id', $borrow->student_id);
            $borrow->student = $student;
            return $borrow;
        });

        return response()->json([
            'success'  => true,
            'borrowed' => $borrows->whereIn('status', ['borrowed', 'request'])->values(),
            'returned' => $borrows->where('status', 'returned')->values(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'due_at' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $borrow = Borrow::create([
                'student_id' => $request->student_id,
                'borrowed_at' => now(),
                'due_at' => $request->due_at,
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $index => $itemId) {
                $quantity = $request->quantities[$index] ?? 1;

                BorrowItem::create([
                    'borrow_id' => $borrow->id,
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                ]);

                $item = Item::findOrFail($itemId);

                if ($item->available_quantity < $quantity) {
                    DB::rollBack();
                    return response()->json([
                        'message' => "Stok untuk item {$item->name} tidak mencukupi"
                    ], 400);
                }

                $item->decrement('available_quantity', $quantity);
            }

            DB::commit();
            RFID::truncate();

            return response()->json([
                'message' => 'Borrow created successfully',
                'data' => $borrow->load('items')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error while creating borrow',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->update($request->all());

        return response()->json(['success' => true, 'data' => $borrow]);
    }

    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();

        return response()->json(['success' => true, 'message' => 'Data peminjaman dihapus']);
    }
}
