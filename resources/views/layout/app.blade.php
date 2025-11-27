<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Peminjaman Alat | RFID')</title>
    <link rel="icon" href="{{ asset('storage/images/logo-smk2klt.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <nav>
        @yield('navbar')
    </nav>

    <main>
        @yield('content')
    </main>

    @include('sweetalert::alert')
</body>
</html>