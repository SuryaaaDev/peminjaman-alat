@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 px-4 sm:px-6 lg:px-8">
        <div class="mt-6">
            <a href="{{ route('items.index') }}"
                class="inline-flex justify-center items-center gap-2 px-3 py-1.5 font-semibold border-2 border-black rounded-lg hover:text-white hover:bg-black transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 12 24" fill="currentColor">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-1">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">📦 Detail Alat</h2>

            <div class="relative w-full h-72 mb-6">
                @if (!empty($item['image']))
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                        class="w-full h-full object-cover rounded-xl shadow-sm border border-gray-200">
                @else
                    <div
                        class="w-full h-64 flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gradient-to-br from-gray-50 to-gray-100 text-gray-500 p-6 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mb-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7h3l2-3h8l2 3h3a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2zm9 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
                        </svg>

                        <p class="text-lg font-semibold text-gray-600">Gambar belum tersedia</p>
                        <span class="text-sm text-gray-400">Unggah gambar untuk mengetahui bentuk fisik alat</span>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Nama</label>
                    <p class="mt-2 text-xl text-gray-900 font-semibold">{{ $item['name'] }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Deskripsi</label>
                    <p class="mt-2 text-lg text-gray-700">{{ $item['description'] ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Jumlah</label>
                    <p class="mt-2 text-xl font-semibold text-blue-600">{{ $item['total_quantity'] }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500 uppercase tracking-wide">Tersedia</label>
                    <p class="mt-2 text-xl font-semibold text-green-600">{{ $item['available_quantity'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
