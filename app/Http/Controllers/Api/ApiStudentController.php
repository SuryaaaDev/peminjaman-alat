<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RFID;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Users retrieved successfully.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string|max:50|unique:users,card_number',
            'name' => 'required|string',
            'class' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3'
        ]);

        $rfid = RFID::first();
        if (!$rfid) {
            return response()->json([
                'success' => false,
                'message' => 'RFID card number is required.'
            ], 400);
        }
 
        $user = User::create([
            'card_number' => $rfid->card_number,
            'name' => $request->name,
            'class' => $request->class,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        RFID::truncate();

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User retrieved successfully.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'card_number' => 'required|string|max:50|unique:users,card_number,' . $id,
            'name' => 'required|string',
            'class' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3'
        ]);

        $user->update([
            'card_number' => $request->card_number ?? $user->card_number,
            'name' => $request->name ?? $user->name,
            'class' => $request->class ?? $user->class,
            'telephone' => $request->telephone ?? $user->telephone,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}
