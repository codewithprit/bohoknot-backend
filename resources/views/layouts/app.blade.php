<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bohoknot')</title>

    <!-- Common CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Page specific CSS -->
    @yield('styles')
</head>
<body>

    {{-- Common Header --}}
    @include('layouts.header')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Common Footer --}}
    @include('layouts.footer')

</body>
</html>
