@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 max-w-screen-xl min-h-screen bg-white mx-auto px-4 py-12 md:px-8">
        <div class="items-center justify-center md:flex mb-4">
            <h3 class="text-gray-800 text-xl text-center font-bold sm:text-2xl">
                Form Peminjaman Barang
            </h3>
        </div>
        <section>
            <div class="container flex items-center justify-center">
                <div
                    class="flex flex-col w-full max-w-xl p-10 mx-auto transition duration-500 ease-in-out transform bg-white rounded-lg md:mt-0">
                    <div>
                        <div>
                            <form action="{{ route('borrows.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
                                    <input type="hidden" id="user_id" name="student_id" />
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-600">Nama
                                        </label>
                                        <div class="mt-1">
                                            <input id="name" name="name" type="text" required
                                                placeholder="Nama Siswa" readonly
                                                class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                        </div>
                                    </div>
                                    <div>
                                        <label for="class" class="block text-sm font-medium text-gray-600">Kelas
                                        </label>
                                        <div class="mt-1">
                                            <input id="class" name="class" type="text" required placeholder="Kelas" readonly
                                                class="block w-full px-5 py-1.5 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" />
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-400 -mt-4">*nama siswa dan kelas akan terisi otomatis</p>
                                <div id="item-container" class="space-y-2">
                                    <label for="items" class="block text-sm font-medium text-gray-600">Barang</label>
                                    <div class="flex space-x-2 items-center w-full mt-1">
                                        <select name="items[]"
                                            class="flex-1 border-2 border-white bg-gray-50 rounded-lg px-5 py-1.5 ring-offset-gray-300 focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                                            required>
                                            <option value="" disabled selected>Pilih Barang</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['name'] }} (Tersedia: {{ $item['available_quantity'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="quantities[]" min="1" value="1"
                                            class="w-20 border rounded-lg px-2 py-1.5 border-white bg-gray-50 ring-offset-gray-300 focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300"
                                            required>
                                        <button onclick="removeItem(this)"
                                            class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-red-500 hover:bg-red-600 focus:bg-red-700 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300 disabled:shadow-none cursor-pointer">
                                            <span class="order-2">Hapus</span>
                                            <span class="relative only:-mx-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6"
                                                        color="currentColor" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <button onclick="addItem()"
                                    class="inline-flex items-center justify-center -mt-8 h-8 gap-2 px-4 text-xs font-medium tracking-wide transition duration-300 rounded focus-visible:outline-none justify-self-center whitespace-nowrap bg-indigo-50 text-indigo-500 hover:bg-indigo-100 hover:text-indigo-600 focus:bg-indigo-200 focus:text-indigo-700 disabled:cursor-not-allowed disabled:border-indigo-300 disabled:bg-indigo-100 disabled:text-indigo-400 disabled:shadow-none cursor-pointer">
                                    <span class="order-2">Tambah Barang</span>
                                    <span class="relative only:-mx-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 16 16">
                                            <path fill="currentColor" d="M14 7H9V2H7v5H2v2h5v5h2V9h5V7z" />
                                        </svg>
                                    </span>
                                </button>
                                <div class="relative">
                                    <label for="due_at" class="block text-sm font-medium text-gray-600">
                                        Tanggal & Waktu Pengembalian
                                    </label>
                                    <input id="due_at" type="datetime-local" name="due_at"
                                        class="relative w-full h-10 px-4 mt-1 text-sm placeholder-transparent transition-all border rounded-lg outline-none peer border-slate-200 text-slate-500 autofill:bg-white focus:border-emerald-500 focus:outline-none focus-visible:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"
                                        required />
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-600">Catatan
                                    </label>
                                    <textarea
                                        class="block w-full px-5 py-3 mt-2 text-base text-gray-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300 apearance-none autoexpand"
                                        id="notes" type="text" name="notes" placeholder="Catatan Peminjaman (Opsional)"></textarea>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="flex items-center justify-center w-full px-10 py-2 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-indigo-600 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan Peminjaman</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function addItem() {
                let container = document.getElementById('item-container');
                let template = `
                    <div class="flex space-x-2 items-center">
                        <select name="items[]" class="flex-1 border-2 border-white bg-gray-50 rounded-lg px-5 py-1.5 ring-offset-gray-300 focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach ($items as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['name'] }} (Tersedia: {{ $item['available_quantity'] }})
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" min="1" value="1"
                            class="w-20 border rounded-lg px-2 py-1.5 border-white bg-gray-50 ring-offset-gray-300 focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300" required>
                        <button onclick="removeItem(this)"
                            class="inline-flex items-center justify-center h-8 gap-2 px-4 text-xs font-medium tracking-wide text-white transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-red-500 hover:bg-red-600 focus:bg-red-700 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300 disabled:shadow-none cursor-pointer">
                            <span class="order-2">Hapus</span>
                            <span class="relative only:-mx-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                    viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5"
                                        d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6"
                                        color="currentColor" />
                                </svg>
                            </span>
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', template);
            }

            function removeItem(btn) {
                btn.parentElement.remove();
            }

            let lastCard = null;

            setInterval(() => {
                fetch("{{ url('/api/rfid-user') }}")
                    .then(res => res.json())
                    .then(rfid => {
                        if (rfid.success && rfid.data && rfid.data.card_number) {
                            const card = rfid.data.card_number;

                            if (card !== lastCard) {
                                lastCard = card;

                                fetch("{{ url('/api/find-by-card') }}?card_number=" + card)
                                    .then(res => res.json())
                                    .then(student => {
                                        let user = student.data ?? null;

                                        if (user) {
                                            document.getElementById('name').value = user.name ??
                                                'Tidak Ditemukan';
                                            document.getElementById('class').value = user.class ??
                                                'Tidak Ditemukan';
                                            document.getElementById('user_id').value = user.id ?? '';
                                        } else {
                                            document.getElementById('name').value = 'Tidak Ditemukan';
                                            document.getElementById('class').value = 'Tidak Ditemukan';
                                            document.getElementById('user_id').value = '';
                                        }
                                    })
                                    .catch(err => console.error("Fetch error:", err));
                            }
                        }
                    })
                    .catch(err => console.error("Fetch error:", err));
            }, 1000);
        </script>
    @endsection
