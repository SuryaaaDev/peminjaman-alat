<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class BorrowController extends Controller
{
    private $apiBase = 'http://localhost:8002/api/borrows';
    private $apiItem = 'http://localhost:8002/api/items';

    public function index()
    {
        $response = Http::get("{$this->apiBase}/");
        $borrows = $response->json()['data'] ?? [];

        $borrowsBorrowed = $response->json()['borrowed'] ?? [];
        $borrowsReturned = $response->json()['returned'] ?? [];
        $allData = $response->json()['data'] ?? [];

        $requestCount = collect($allData)->where('status', 'request')->count();

        $title = 'Hapus Peminjaman';
        $text = "Apakah anda yakin untuk menghapus data peminjaman ini?";
        confirmDelete($title, $text);
        return view('borrows.index', compact('borrowsBorrowed', 'borrowsReturned', 'requestCount'));
    }

    public function borrow()
    {
        $responseItem = Http::get($this->apiItem);
        $items = $responseItem->json()['data'] ?? [];

        return view('borrows.formBorrow', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'due_at' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $response = Http::post("{$this->apiBase}/", $validated);


        if ($response->successful()) {
            Alert::success('Berhasil', 'Peminjaman berhasil disimpan');
            return back();
        }

        Alert::error('Error', 'Gagal menyimpan peminjaman');
        return back();
    }

    public function returnItem($id)
    {
        Http::post("{$this->apiBase}/borrows/{$id}/return");
        return back()->with('status', 'Barang berhasil dikembalikan');
    }

    public function destroy($id)
    {
        Http::delete("{$this->apiBase}/{$id}");
        return back()->with('status', 'Data peminjaman dihapus');
    }
}
