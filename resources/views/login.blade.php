@extends('layout.app')

@section('content')
    <div class="flex justify-center items-center h-screen w-screen">
        <div class="w-full max-w-sm p-6 m-auto mx-auto bg-white rounded-lg shadow-md">
            <div class="justify-center mx-auto">
                <h3 class="mt-3 text-xl font-medium text-center text-gray-600">Welcome Back</h3>
                <p class="mt-1 text-center text-gray-500">Login or create account</p>
            </div>

            <form class="mt-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm text-gray-800">Email</label>
                    <input type="email" name="email" id="email" required
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" />
                </div>

                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm text-gray-800">Password</label>
                        {{-- <a href="#" class="text-xs text-gray-600 hover:underline">Forget
                            Password?</a> --}}
                    </div>

                    <input type="password" name="password" id="password" required
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-lg focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" />
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-2.5 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        Sign In
                    </button>
                </div>
            </form>

            <p class="mt-8 text-xs font-light text-center text-gray-400"> Created by <a href="#"
                    class="font-medium text-gray-700 hover:underline">VortechDev</a></p>
        </div>
    </div>
@endsection
