@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 max-w-screen-xl h-screen bg-white mx-auto px-4 py-12 md:px-8">
        <div class="items-start justify-between md:flex mb-4">
            <div class="max-w-lg">
                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                    History WhatsApp
                    <span class="text-gray-500 font-normal">({{ count($histories) }})</span>
                </h3>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border border-separate rounded border-slate-200" cellspacing="0">
                <tbody>
                    <tr>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Nama</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Kelas</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Telepon</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Pesan</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Dikirim pada</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Status</th>
                    </tr>
                    @if (empty($histories))
                        <tr class="transition-colors duration-300 hover:bg-slate-50">
                            <td colspan="6"
                                class="h-12 text-center px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($histories as $history)
                            <tr class="transition-colors duration-300 hover:bg-slate-50">
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $history['user']['name'] }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $history['user']['class'] }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $history['phone'] }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm border-t border-l border-slate-200 text-slate-500">
                                    <span title="{{ $history['message'] ?? '-' }}">
                                        {{ Str::limit($history['message'] ?? '-', 50) }}
                                    </span>
                                </td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ date('d-m-Y H:i', strtotime($history['sent_at'])) }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    @if ($history['status'] == 'success')
                                        <span
                                            class="inline-flex items-center justify-center gap-1 rounded px-2 py-1 text-sm shadow-xs font-medium bg-green-100 text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="m8 12l3 3l5-6" />
                                                </g>
                                            </svg>
                                            Success
                                        </span>
                                    @elseif ($history['status'] == 'failed')
                                        <span
                                            class="inline-flex items-center justify-center gap-1 rounded px-2 py-1 text-sm shadow-xs font-medium bg-red-100 text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m9 9l3 3m0 0l3 3m-3-3l-3 3m3-3l3-3m-3 12a9 9 0 1 1 0-18a9 9 0 0 1 0 18Z" />
                                            </svg>
                                            Failed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
