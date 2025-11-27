@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="mt-6 sm:ml-80 ml-5">
        <a href="{{ route('borrows.index') }}"
            class="inline-flex justify-center items-center gap-2 px-3 py-1.5 font-semibold border-2 border-black rounded-lg hover:text-white hover:bg-black transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 12 24" fill="currentColor">
                <path fill="currentColor" fill-rule="evenodd"
                    d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>
    <div class="sm:ml-72 max-w-screen-xl h-screen bg-white mx-auto px-4 py-8 md:px-8">
        <div class="max-w-lg flex gap-2">
            <h1 class="text-xl font-bold mb-4">Persetujuan Pengembalian</h1>
            <span class="text-gray-500 font-normal">({{ count($borrows) }})</span>
        </div>

        @if (!empty($error))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ $error }}</div>
        @endif

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border border-separate rounded border-slate-200" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Nama</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Kelas</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Alat Dipinjam</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Tenggat Pengembalian</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Catatan</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($borrows))
                        <tr class="transition-colors duration-300 hover:bg-slate-50">
                            <td colspan="6"
                                class="h-12 text-center px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($borrows as $borrow)
                            <tr class="transition-colors duration-300 hover:bg-slate-50">
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $borrow['student']['name'] ?? '-' }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $borrow['student']['class'] ?? '-' }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    @foreach ($borrow['items'] as $item)
                                        <li>{{ $item['name'] }} (x{{ $item['pivot']['quantity'] }})</li>
                                    @endforeach
                                </td>
                                <td
                                    class="h-12 w-40 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ date('d-m-Y H:i', strtotime($borrow['due_at'])) }}</td>
                                <td
                                    class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $borrow['notes'] ?? '-' }}</td>
                                <td
                                    class="h-12 w-10 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    <div class="inline-flex overflow-hidden rounded">
                                        <form action="{{ route('approval.reject', $borrow['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-confirm-delete="true"
                                                class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 focus:text-red-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-100 disabled:text-red-400 disabled:shadow-none cursor-pointer">
                                                <span class="relative only:-mx-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5"
                                                            d="m9 9l3 3m0 0l3 3m-3-3l-3 3m3-3l3-3m-3 12a9 9 0 1 1 0-18a9 9 0 0 1 0 18Z" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                        <button popovertarget="approved-{{ $borrow['id'] }}" popovertargetaction="show"
                                            type="button"
                                            class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-green-50 text-green-500 hover:bg-green-100 hover:text-green-600 focus:bg-green-200 focus:text-green-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-green-300 disabled:bg-green-100 disabled:text-green-400 disabled:shadow-none cursor-pointer">
                                            <span class="relative only:-mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    viewBox="0 0 1024 1024" fill="currentColor">
                                                    <path fill="currentColor"
                                                        d="M512 0C229.232 0 0 229.232 0 512c0 282.784 229.232 512 512 512c282.784 0 512-229.216 512-512C1024 229.232 794.784 0 512 0zm0 961.008c-247.024 0-448-201.984-448-449.01c0-247.024 200.976-448 448-448s448 200.977 448 448s-200.976 449.01-448 449.01zm204.336-636.352L415.935 626.944l-135.28-135.28c-12.496-12.496-32.752-12.496-45.264 0c-12.496 12.496-12.496 32.752 0 45.248l158.384 158.4c12.496 12.48 32.752 12.48 45.264 0c1.44-1.44 2.673-3.009 3.793-4.64l318.784-320.753c12.48-12.496 12.48-32.752 0-45.263c-12.512-12.496-32.768-12.496-45.28 0z" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <section popover id="approved-{{ $borrow['id'] }}">
                                <div
                                    class="fixed inset-0 z-50 min-h-screen w-full flex justify-center items-center py-14 px-4 bg-black/40 transition overflow-y-scroll">
                                    <div
                                        class="flex flex-col w-full max-w-3xl px-10 py-8 mx-auto my-6 transition duration-500 ease-in-out transform bg-white rounded-lg md:mt-0">
                                        <div class="flex w-full justify-end">
                                            <button type="button" popovertarget="approved-{{ $borrow['id'] }}"
                                                popovertargetaction="hide"
                                                class="cursor-pointer rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                                                <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div>
                                            <form action="{{ route('approval.approve', $borrow['id']) }}" method="POST"
                                                class="space-y-2">
                                                @csrf
                                                <h1 class="text-lg font-bold mb-4">Setujui Pengembalian</h1>

                                                <div>
                                                    <p class="mb-2 text-sm text-gray-700">Centang semua alat yang sudah
                                                        dikembalikan oleh siswa.</p>
                                                    @foreach ($borrow['items'] as $item)
                                                        <div class="relative flex flex-wrap items-center">
                                                            <input
                                                                class="w-4 h-4 transition-colors bg-white border-2 rounded appearance-none cursor-pointer focus-visible:outline-none peer border-slate-500 checked:border-emerald-500 checked:bg-emerald-500 checked:hover:border-emerald-600 checked:hover:bg-emerald-600 focus:outline-none checked:focus:border-emerald-700 checked:focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-slate-100 disabled:bg-slate-50"
                                                                type="checkbox" id="{{ $item['name'] }}" required />
                                                            <label
                                                                class="pl-2 cursor-pointer text-slate-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400"
                                                                for="{{ $item['name'] }}">
                                                                {{ $item['name'] }} (x{{ $item['pivot']['quantity'] }})
                                                            </label>
                                                            <svg class="absolute left-0 w-4 h-4 transition-all duration-300 -rotate-90 opacity-0 pointer-events-none top-1 fill-white stroke-white peer-checked:rotate-0 peer-checked:opacity-100 peer-disabled:cursor-not-allowed"
                                                                viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                                aria-labelledby="title-1 description-1"
                                                                role="graphics-symbol">
                                                                <title id="title-1">Check mark icon</title>
                                                                <desc id="description-1">
                                                                    Check mark icon to indicate whether the radio input is
                                                                    checked
                                                                    or not.
                                                                </desc>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M12.8116 5.17568C12.9322 5.2882 13 5.44079 13 5.5999C13 5.759 12.9322 5.91159 12.8116 6.02412L7.66416 10.8243C7.5435 10.9368 7.37987 11 7.20925 11C7.03864 11 6.87501 10.9368 6.75435 10.8243L4.18062 8.42422C4.06341 8.31105 3.99856 8.15948 4.00002 8.00216C4.00149 7.84483 4.06916 7.69434 4.18846 7.58309C4.30775 7.47184 4.46913 7.40874 4.63784 7.40737C4.80655 7.406 4.96908 7.46648 5.09043 7.57578L7.20925 9.55167L11.9018 5.17568C12.0225 5.06319 12.1861 5 12.3567 5C12.5273 5 12.691 5.06319 12.8116 5.17568Z" />
                                                            </svg>
                                                        </div>
                                                    @endforeach
                                                    <div class="p-6 max-w-2xl mx-auto">
                                                        <div
                                                            class="rounded-2xl border border-yellow-300 bg-yellow-50 p-5 shadow-md">
                                                            <div class="flex items-start gap-3">
                                                                <div class="flex-shrink-0">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-6 w-6 text-yellow-500" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                                        stroke-width="2">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                    </svg>
                                                                </div>

                                                                <div>
                                                                    <h2 class="text-lg font-semibold text-yellow-800">
                                                                        Perhatian</h2>
                                                                    <p
                                                                        class="mt-2 text-sm text-yellow-700 leading-relaxed">
                                                                        Pengembalian hanya dapat dilakukan apabila
                                                                        <span class="font-semibold">semua barang yang
                                                                            dipinjam sudah dikembalikan</span>.
                                                                        Jika masih ada barang yang belum dikembalikan, maka
                                                                        proses pengembalian
                                                                        <span class="font-semibold">tidak dapat
                                                                            dilanjutkan</span>.
                                                                    </p>
                                                                    <p
                                                                        class="mt-2 text-sm text-yellow-700 leading-relaxed">
                                                                        Untuk melakukan peminjaman ulang pada barang yang
                                                                        sama, silakan
                                                                        <span class="font-semibold">kembalikan barang
                                                                            terlebih dahulu</span>
                                                                        kemudian lakukan peminjaman kembali.
                                                                    </p>
                                                                    <p
                                                                        class="mt-2 text-sm text-yellow-700 leading-relaxed">
                                                                        ⚡ Setiap kartu hanya dapat digunakan untuk
                                                                        <span class="font-semibold">satu peminjaman
                                                                            aktif</span> pada satu waktu.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 pt-4">
                                                    <button type="button" popovertarget="approved-{{ $borrow['id'] }}"
                                                        popovertargetaction="hide"
                                                        class="px-5 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition font-medium cursor-pointer">
                                                        Batal
                                                    </button>
                                                    <button type="submit"
                                                        class="px-5 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-medium cursor-pointer">
                                                        Setujui
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
