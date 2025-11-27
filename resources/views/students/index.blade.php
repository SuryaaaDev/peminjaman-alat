@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 max-w-screen-xl h-screen bg-white mx-auto px-4 py-12 md:px-8">
        <div class="items-start justify-between flex mb-4">
            <div class="max-w-lg">
                <h3 class="text-gray-800 text-xl font-bold sm:text-2xl">
                    Daftar Siswa
                    <span class="text-gray-500 font-normal">({{ count($students) }})</span>
                </h3>
            </div>
            <div class="mt-3 md:mt-0">
                <span class="relative overflow-hidden cursor-pointer group hover:overflow-visible focus-visible:outline-none"
                    aria-describedby="tooltip-02">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 32 32" fill="#000000">
                        <g fill="none" stroke="#000000">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 14h1v9h1m12-7a13 13 0 1 1-26 0a13 13 0 0 1 26 0Z" />
                            <path fill="#000000" d="M17 9.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z" />
                        </g>
                    </svg>
                    <span role="tooltip" id="tooltip-02"
                        class="invisible absolute right-full top-1/2 z-10 mr-2 mt-2 w-48 -translate-y-1/2 rounded bg-gray-100 p-4 text-sm shadow-md opacity-0 transition-all before:invisible before:absolute before:top-1/2 before:left-full before:z-10 before:mr-2 before:-mt-2 before:border-y-8 before:border-l-8 before:border-y-transparent before:border-l-gray-100 before:opacity-0 before:transition-all before:content-[''] group-hover:visible group-hover:block group-hover:opacity-100 group-hover:before:visible group-hover:before:opacity-100">Semua
                        Data Siswa diambil dari <a href="https://absensi.vortech.my.id" class="hover:underline">Website
                            Absensi</a>, Jika ingin menambahkan data hubungi Admin Absensi</span>
                </span>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            @if ($error)
                <div class="inline-flex gap-2 py-3 px-5 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 42 42"
                        fill="#b91c1c">
                        <path fill="#b91c1c"
                            d="M18.295 3.895L1.203 34.555C-.219 37.146.385 39.5 4.228 39.5H36.77c3.854 0 4.447-2.354 3.025-4.945L22.35 3.914c-.354-.691-.868-1.424-1.957-1.414c-1.16.021-1.735.703-2.098 1.395zM18.5 13.5h4v14h-4v-14zm0 17h4v4h-4v-4z" />
                    </svg>
                    <span>
                        {{ $error }}
                    </span>
                </div>
            @endif
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
                            Email</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 border-slate-200 stroke-slate-700 text-slate-700 bg-slate-100">
                            Aksi</th>
                    </tr>
                    @if (empty($students))
                        <tr class="transition-colors duration-300 hover:bg-slate-50">
                            <td colspan="5"
                                class="h-12 text-center px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($students as $student)
                            <tr class="transition-colors duration-300 hover:bg-slate-50">
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $student['name'] }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $student['class']['class_name'] ?? '-' }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $student['telepon'] }}</td>
                                <td
                                    class="h-12 whitespace-nowrap px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    {{ $student['email'] }}</td>
                                <td
                                    class="h-12 w-10 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                                    <div class="inline-flex overflow-hidden rounded">
                                        <a href="{{ route('students.show', $student['id']) }}"
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
