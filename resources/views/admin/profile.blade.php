@extends('layout.app')

@section('navbar')
    @include('layout.navbar-admin')
@endsection

@section('content')
    <div class="sm:ml-72 flex justify-center items-center">
        <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-32 relative">
                    <div class="absolute -bottom-12 left-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=128"
                            alt="Avatar" class="w-24 h-24 rounded-full border-4 border-white shadow-md">
                    </div>
                </div>

                <div class="pt-16 pb-8 px-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ Auth::user()->name }}
                    </h2>
                    <p>
                        {{ Auth::user()->is_admin ? 'Admin' : Auth::user()->class }}
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-lg font-medium text-gray-800">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <p class="text-sm text-gray-500">No. Telepon</p>
                            <p class="text-lg font-medium text-gray-800">
                                {{ Auth::user()->telephone ?? '-' }}
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <p class="text-sm text-gray-500">Role</p>
                            <p class="text-lg font-medium text-gray-800 capitalize">
                                {{ Auth::user()->is_admin ? 'Admin' : 'User' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href=""
                            class="px-5 py-2 w-max rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                            Edit Profil
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-5 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
