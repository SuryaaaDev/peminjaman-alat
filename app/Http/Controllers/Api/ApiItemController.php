<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        if ($items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'Items retrieved successfully.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'description'  => 'nullable|string',
            'total_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        }

        $item = Item::create([
            'name'  => $request->name,
            'description'  => $request->description,
            'total_quantity' => $request->total_quantity,
            'available_quantity' => $request->total_quantity,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'data'    => $item,
            'message' => 'Item ' . $item->name . ' created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'total_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $borrowed = $item->total_quantity - $item->available_quantity;
        $item->total_quantity = $validated['total_quantity'];
        $item->available_quantity = max($item->total_quantity - $borrowed, 0);

        $item->name = $validated['name'];
        $item->description = $validated['description'] ?? $item->description;

        if ($request->hasFile('image')) {
            if ($item->image && file_exists(public_path('storage/' . $item->image))) {
                unlink(public_path('storage/' . $item->image));
            }

            $path = $request->file('image')->store('items', 'public');
            $item->image = $path;
        }

        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully.',
            'data' => $item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully.'
        ]);
    }
}
