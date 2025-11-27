<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    protected $apiUrl = "http://localhost:8002/api/items";

    public function index()
    {
        $response = Http::get($this->apiUrl . '/');
        $items = $response->json()['data'] ?? [];

        $title = 'Hapus Item';
        $text = "Apakah anda yakin untuk menghapus item ini?";
        confirmDelete($title, $text);

        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string',
            'description'  => 'nullable|string',
            'total_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $http = Http::attach(
                'image',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post($this->apiUrl, [
                'name'               => $request->name,
                'description'        => $request->description,
                'total_quantity'     => $request->total_quantity,
                'available_quantity' => $request->total_quantity,
            ]);
        } else {
            $http = Http::post($this->apiUrl, [
                'name'               => $request->name,
                'description'        => $request->description,
                'total_quantity'     => $request->total_quantity,
                'available_quantity' => $request->total_quantity,
            ]);
        }

        if ($http->successful()) {
            Alert::success('Berhasil', 'Item berhasil ditambahkan');
            return redirect()->route('items.index');
        }

        return back()->with('error', 'Gagal menambahkan item.')->withInput();
    }


    public function show($id)
    {
        $response = Http::get($this->apiUrl . '/' . $id);
        $item = $response->json()['data'] ?? null;

        return view('items.show', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string',
            'description'  => 'nullable|string',
            'total_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $http = Http::asMultipart();

        if ($request->hasFile('image')) {
            $http->attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            );
        }

        $response = $http->post($this->apiUrl . '/' . $id, [
            '_method' => 'PUT',
            'name' => $request->name,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description,
        ]);

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Gagal update item']);
        }

        Alert::success('Berhasil', 'Item berhasil diupdate');
        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        Http::delete($this->apiUrl . '/' . $id);

        return redirect()->route('items.index');
    }
}
