@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 max-w-screen-xl h-screen bg-white mx-auto px-4 py-12 md:px-8">
        <div class="items-start justify-between md:flex mb-4">
            <div class="max-w-lg">
                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                    Daftar Alat
                    <span class="text-gray-500 font-normal">({{ count($items) }})</span>
                </h3>
            </div>
            <div class="mt-3 md:mt-0">
                <button popovertarget="add-item"
                    class="inline-block px-4 py-2 text-white duration-150 font-medium bg-indigo-600 rounded-lg hover:bg-indigo-500 active:bg-indigo-700 md:text-sm cursor-pointer">Tambah
                    Alat</button>
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
                            Deskripsi</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Jumlah</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Tersedia</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Aksi</th>
                    </tr>
                    @if (empty($items))
                        <tr class="transition-colors duration-300 hover:bg-slate-50">
                            <td colspan="5"
                                class="h-12 text-center px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($items as $item)
                            <tr class="transition-colors duration-300 hover:bg-slate-50">
                                <td
                                    class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $item['name'] }}</td>
                                <td
                                    class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $item['description'] ?? '-' }}</td>
                                <td
                                    class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $item['total_quantity'] }}</td>
                                <td
                                    class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $item['available_quantity'] }}</td>
                                <td
                                    class="h-12 w-10 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    <div class="inline-flex overflow-hidden rounded">
                                        <a href="{{ route('items.show', $item['id']) }}"
                                            class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-emerald-50 text-emerald-500 hover:bg-emerald-100 hover:text-emerald-600 focus:bg-emerald-200 focus:text-emerald-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-emerald-300 disabled:bg-emerald-100 disabled:text-emerald-400 disabled:shadow-none cursor-pointer">
                                            <span class="relative only:-mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045" />
                                                        <path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>
                                        <button popovertarget="edit-item-{{ $item['id'] }}"
                                            class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-blue-50 text-blue-500 hover:bg-blue-100 hover:text-blue-600 focus:bg-blue-200 focus:text-blue-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-100 disabled:text-blue-400 disabled:shadow-none cursor-pointer">
                                            <span class="relative only:-mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 21h16M5.666 13.187A2.278 2.278 0 0 0 5 14.797V18h3.223c.604 0 1.183-.24 1.61-.668l9.5-9.505a2.278 2.278 0 0 0 0-3.22l-.938-.94a2.277 2.277 0 0 0-3.222.001l-9.507 9.52Z" />
                                                </svg>
                                            </span>
                                        </button>
                                        <a href="{{ route('items.destroy', $item['id']) }}" data-confirm-delete="true"
                                            class="inline-flex items-center self-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 justify-self-center whitespace-nowrap bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 focus:text-red-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-100 disabled:text-red-400 disabled:shadow-none cursor-pointer">
                                            <span class="relative only:-mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6"
                                                        color="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            {{-- POPOVER EDIT --}}
                            <section popover id="edit-item-{{ $item['id'] }}">
                                <div
                                    class="fixed inset-0 z-50 min-h-screen w-full flex justify-center items-center py-10 px-4 bg-black/40 transition overflow-y-scroll">
                                    <div
                                        class="flex flex-col w-full max-w-md px-10 py-8 mx-auto my-6 transition duration-500 ease-in-out transform bg-white rounded-lg md:mt-0">
                                        <div class="flex w-full justify-end">
                                            <button type="button" popovertarget="edit-item-{{ $item['id'] }}"
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
                                        <div class="mt-8">
                                            <div class="mt-6">
                                                <form action="{{ route('items.update', $item['id']) }}" method="POST"
                                                    class="space-y-6" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="flex flex-col w-full">
                                                        <label for="file-upload" class="w-full">
                                                            <div
                                                                class="relative flex-col w-full p-6 border-2 border-dashed rounded-lg flex items-center justify-center cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-12 h-12 mb-3 text-blue-500" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4" />
                                                                </svg>
                                                                <p class="text-gray-600 font-medium">Upload gambar baru di
                                                                    sini
                                                                </p>
                                                                <p class="text-sm text-gray-400">klik untuk ganti gambar
                                                                </p>
                                                                <input type="file" name="image" accept="image/*"
                                                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                                                            </div>
                                                        </label>

                                                        <div class="my-4">
                                                            <p class="text-sm text-gray-500 mb-2">Gambar Saat Ini:</p>
                                                            @if ($item['image'])
                                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                                    alt="item" width="100">
                                                            @else
                                                                <p class="text-sm text-gray-300">belum ada gambar</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
                                                        <div>
                                                            <label for="email"
                                                                class="block text-sm font-medium text-gray-600">Nama
                                                            </label>
                                                            <div class="mt-1">
                                                                <input id="name" name="name" type="text"
                                                                    autocomplete="name" required placeholder="Nama Alat"
                                                                    value="{{ $item['name'] }}"
                                                                    class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                                            </div>
                                                        </div>
                                                        <div class="space-y-1">
                                                            <label for="total_quantity"
                                                                class="block text-sm font-medium text-gray-600">Jumlah</label>
                                                            <div class="mt-1">
                                                                <input id="total_quantity" name="total_quantity"
                                                                    type="number" required placeholder="Jumlah Alat"
                                                                    value="{{ $item['total_quantity'] }}"
                                                                    class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <label for="email"
                                                            class="block text-sm font-medium text-gray-600">Deskripsi
                                                        </label>
                                                        <textarea
                                                            class="block w-full px-5 py-3 mt-2 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 mt- focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300 apearance-none autoexpand"
                                                            id="description" type="text" name="description" placeholder="Deskripsi Barang (Opsional)">{{ $item['description'] }}</textarea>
                                                    </div>

                                                    <div>
                                                        <button type="submit"
                                                            class="flex items-center justify-center w-full px-10 py-2 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 mt-6 focus:ring-offset-2 focus:ring-blue-500">Update</button>
                                                    </div>
                                                </form>
                                            </div>
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

    <section popover id="add-item">
        <div
            class="fixed inset-0 z-50 min-h-screen w-full flex justify-center items-center py-14 px-4 bg-black/40 transition overflow-y-scroll">
            <div
                class="flex flex-col w-full max-w-md px-10 py-8 mx-auto my-6 transition duration-500 ease-in-out transform bg-white rounded-lg md:mt-0">
                <div class="flex w-full justify-end">
                    <button type="button" popovertarget="add-item" popovertargetaction="hide"
                        class="cursor-pointer rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                        <svg class="w-6 h-6 text-gray-800 hover:text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                    </button>
                </div>
                <div class="mt-8">
                    <div class="mt-6">
                        <form action="{{ route('items.store') }}" method="POST" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col w-full">
                                <label for="file-upload" class="w-full">
                                    <div
                                        class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 text-blue-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4" />
                                        </svg>

                                        <p class="text-gray-600 font-medium">Upload gambar di sini</p>
                                        <p class="text-sm text-gray-400">klik untuk memilih file</p>
                                    </div>
                                </label>

                                <input id="file-upload" type="file" name="image" accept="image/*" class="hidden"
                                    onchange="previewImage(event)" />

                                <div id="preview-container" class="mt-4 hidden">
                                    <p class="text-sm text-gray-500 mb-2">Preview (klik gambar untuk zoom):</p>
                                    <img id="preview-image" src="#" alt="Preview"
                                        class="w-28 h-28 object-cover rounded-xl shadow-md border border-gray-200 cursor-pointer"
                                        onclick="openModal()" />
                                </div>
                            </div>

                            <div id="imageModal"
                                class="fixed inset-0 z-50 hidden bg-black/40 transition h-screen w-screen flex items-center justify-center">
                                <div class="relative">
                                    <img id="modalImage" src="#" alt="Zoom"
                                        class="max-w-[90vw] max-h-[80vh] rounded-lg shadow-lg transform transition-transform duration-200"
                                        style="scale:1;" />
                                    <button type="button" onclick="closeModal()"
                                        class="absolute top-2 -right-15 cursor-pointer rounded-md focus:outline-none bg-red-500 hover:bg-red-700 text-white hover:text-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-black">
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                    </button>
                                    <div class="flex flex-col absolute top-20 -right-40 justify-end gap-4 mt-4">
                                        <button onclick="zoomIn()"
                                            class="flex justify-center items-center bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                viewBox="0 0 512 512">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M213.334 42.667C307.435 42.667 384 119.232 384 213.334c0 39.381-13.546 75.584-36.01 104.469l121.3 121.323l-30.165 30.165L317.803 347.99C288.918 370.454 252.715 384 213.333 384c-94.1 0-170.666-76.565-170.666-170.666c0-94.102 76.565-170.667 170.667-170.667m0 42.667c-70.592 0-128 57.408-128 128s57.408 128 128 128s128-57.408 128-128s-57.408-128-128-128M234.667 128v64h64v42.667h-64v64H192v-64h-64V192h64v-64z" />
                                            </svg>
                                            Zoom In</button>
                                        <button onclick="resetZoom()"
                                            class="flex justify-center items-center bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M2 12c0 5.523 4.477 10 10 10s10-4.477 10-10S17.523 2 12 2v2a8 8 0 1 1-5.135 1.865L9 8V2H3l2.446 2.447A9.98 9.98 0 0 0 2 12" />
                                            </svg>
                                            Reset</button>
                                        <button onclick="zoomOut()"
                                            class="flex justify-center items-center bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                                                <path fill="currentColor"
                                                    d="M8 15a7 7 0 0 0 4.2-1.4l5.4 5.4l1.4-1.4l-5.4-5.4A7 7 0 1 0 8 15Zm0-2A5 5 0 1 1 8 3a5 5 0 0 1 0 10ZM5 7h6v2H5Z" />
                                            </svg>
                                            Zoom Out</button>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-600">Nama
                                    </label>
                                    <div class="mt-1">
                                        <input id="name" name="name" type="text" autocomplete="name" required
                                            placeholder="Nama Item"
                                            class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label for="total_quantity"
                                        class="block text-sm font-medium text-gray-600">Jumlah</label>
                                    <div class="mt-1">
                                        <input id="total_quantity" name="total_quantity" type="number" required
                                            placeholder="Jumlah Barang"
                                            class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-600">Deskripsi
                                </label>
                                <textarea
                                    class="block w-full px-5 py-3 mt-2 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300 apearance-none autoexpand"
                                    id="description" type="text" name="description" placeholder="Deskripsi Barang (Opsional)"></textarea>
                            </div>

                            <div>
                                <button type="submit"
                                    class="flex items-center justify-center w-full px-10 py-2 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let zoomLevel = 1;

        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById("preview-container");
            const previewImage = document.getElementById("preview-image");
            const modalImage = document.getElementById("modalImage");

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    modalImage.src = e.target.result;
                    previewContainer.classList.remove("hidden");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function openModal() {
            document.getElementById("imageModal").classList.remove("hidden");
            zoomLevel = 1;
            resetZoom();
        }

        function closeModal() {
            document.getElementById("imageModal").classList.add("hidden");
        }

        function zoomIn() {
            zoomLevel += 0.2;
            document.getElementById("modalImage").style.scale = zoomLevel;
        }

        function zoomOut() {
            if (zoomLevel > 0.4) zoomLevel -= 0.2;
            document.getElementById("modalImage").style.scale = zoomLevel;
        }

        function resetZoom() {
            zoomLevel = 1;
            document.getElementById("modalImage").style.scale = zoomLevel;
        }
    </script>
@endsection
