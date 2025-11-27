@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 max-w-screen-xl h-screen bg-white mx-auto px-4 py-12 md:px-8">
        <div class="items-start justify-between md:flex mb-4">
            <div class="max-w-lg">
                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                    Daftar Peminjaman
                </h3>
            </div>
            <div class="flex gap-2 mt-3 md:mt-0">
                <a href="{{ route('approval.index') }}"
                    class="inline-flex cursor-pointer items-center justify-center h-10 gap-1 px-5 text-sm font-medium tracking-wide transition duration-300 border rounded-lg focus-visible:outline-none justify-self-center whitespace-nowrap border-indigo-500 text-indigo-500 hover:border-indigo-600 hover:text-white hover:bg-indigo-600 focus:border-indigo-700 focus:text-white disabled:cursor-not-allowed disabled:border-indigo-300 disabled:text-indigo-300 disabled:shadow-none">
                    <span>Permintaan</span>
                    <span class="relative only:-mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5.5 h-5.5" viewBox="0 0 24 24"
                            fill="currentColor" role="graphics-symbol" aria-labelledby="title-70 desc-70">
                            <g fill="none" stroke="currentColor" role="graphics-symbol" aria-labelledby="title-70 desc-70" stroke-linecap="round" stroke-width="2">
                                <path d="M12 21a9 9 0 1 0-6.364-2.636" />
                                <path
                                    d="m16 10l-3.598 4.318c-.655.786-.983 1.18-1.424 1.2c-.44.02-.803-.343-1.527-1.067L8 13" />
                            </g>
                        </svg>
                        @if ($requestCount)
                            <span
                                class="absolute -top-2 left-2.5 inline-flex items-center justify-center gap-1 rounded-full bg-pink-500 px-1.5 text-xs text-white hover:border-indigo-600">
                                {{ $requestCount }}
                            </span>
                        @endif
                    </span>
                </a>
                <a href="{{ route('borrows.form') }}"
                    class="flex justify-center items-center px-4 py-2 text-white duration-150 font-medium bg-indigo-600 rounded-lg hover:bg-indigo-500 active:bg-indigo-700 md:text-sm">Tambah
                    Peminjaman</a>
            </div>
        </div>
        <div>
            <div class="max-w-lg flex gap-2">
                <h2 class="text-lg font-bold mb-2">Sedang Dipinjam</h2>
                <span class="text-gray-500 font-normal">({{ count($borrowsBorrowed) }})</span>
            </div>

            @include('borrows.table', [
                'borrows' => $borrowsBorrowed,
                'status' => 'Dipinjam',
            ])

            <div class="max-w-lg flex gap-2 mt-4">
                <h2 class="text-lg font-bold mb-2">Sudah Dikembalikan</h2>
                <span class="text-gray-500 font-normal">({{ count($borrowsReturned) }})</span>
            </div>
            @include('borrows.table', [
                'borrows' => $borrowsReturned,
                'status' => 'Dikembalikan',
            ])
        </div>
    </div>
@endsection
