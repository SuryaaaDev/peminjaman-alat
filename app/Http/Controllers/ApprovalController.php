<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends Controller
{
    
    private $apiBase = 'http://localhost:8002/api/approvals';

    public function index()
    {
        $borrows = [];
        $error = null;

        try {
            $response = Http::get($this->apiBase);

            if ($response->successful()) {
                $borrows = $response->json()['data'] ?? [];
            } else {
                $error = "Gagal mengambil data dari API (status: {$response->status()})";
            }
        } catch (\Exception $e) {
            $error = "Server API tidak bisa dihubungi.";
        }

        return view('borrows.approval', compact('borrows', 'error'));
    }

    public function approve($id)
    {
        $response = Http::post("{$this->apiBase}/{$id}/approve");

        if ($response->successful()) {
            Alert::success('Berhasil', 'Pengembalian berhasil disetujui.');
            return redirect()->route('approval.index');
        }

        Alert::error('Error', 'Gagal menyetujui pengembalian.');
        return redirect()->route('approval.index');
    }

    public function reject($id)
    {
        $response = Http::post("{$this->apiBase}/{$id}/reject");

        if ($response->successful()) {
            Alert::success('Berhasil', 'Pengembalian berhasil ditolak.');
            return redirect()->route('approval.index');
        }
        
        Alert::error('Error', 'Gagal menolak pengembalian.');
        return redirect()->route('approval.index');
    }
}
