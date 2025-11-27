<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    private $apiBase = 'http://localhost:8001/api/students';

    public function index()
    {
        $students = [];
        $error = null;

        try {
            $response = Http::timeout(3)->get($this->apiBase . '/');

            if ($response->successful()) {
                $students = $response->json()['data'] ?? [];
            } else {
                $error = "Gagal mengambil data siswa dari API (status: " . $response->status() . ")";
            }
        } catch (\Exception $e) {
             $error = "Server absensi tidak bisa dihubungi. Silakan coba beberapa saat lagi.";
        }

        return view('students.index', compact('students', 'error'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_number' => 'required|string|max:50|unique:users,card_number',
            'name' => 'required|string',
            'class' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3'
        ]);

        $response = Http::post($this->apiBase . '/', $validated);

        if ($response->successful()) {
            Alert::success('Berhasil', 'Data siswa berhasil ditambahkan');
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Failed to create student.');
    }

    public function show($id)
    {
        $response = Http::get($this->apiBase . '/' . $id);
        $student = $response->json()['data'] ?? null;

        return view('students.show', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'card_number' => 'required|string|max:50',
            'name' => 'required|string',
            'class' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:3'
        ]);

        Http::put($this->apiBase . '/' . $id, $validated);

        Alert::success('Berhasil', 'Data siswa berhasil diupdate');
        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        Http::delete($this->apiBase . '/' . $id);
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
}
