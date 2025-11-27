@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 px-4 sm:px-6 lg:px-8">
        <div class="mt-6">
            <a href="{{ route('students.index') }}"
                class="inline-flex justify-center items-center gap-2 px-3 py-1.5 font-semibold border-2 border-black rounded-lg hover:text-white hover:bg-black transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 12 24" fill="currentColor">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="m3.343 12l7.071 7.071L9 20.485l-7.778-7.778a1 1 0 0 1 0-1.414L9 3.515l1.414 1.414z" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-6 mt-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Siswa</h2>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="w-40 aspect-square rounded-full overflow-hidden border-4 border-indigo-500 shadow-md">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student['name']) }}&size=256"
                        alt="{{ $student['name'] }}" class="w-full h-full object-cover">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $student['name'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Kelas</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $student['class']['class_name'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nomor RFID</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $student['card_number'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">No Telepon</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $student['telepon'] ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $student['email'] ?? '-' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Daftar</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ $student['created_at'] ? \Carbon\Carbon::parse($student['created_at'])->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
