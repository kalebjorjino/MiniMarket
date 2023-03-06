<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'SAM-J KMART') }}</title>
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    @vite('resources/css/app.css')

</head>

<body>

    <div class="row g-0 auth-row vh-100">
        @yield('content')
    </div>

    <!-- ========= All Javascript files linkup ======== -->
    {{-- Custom Script --}}
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- @vite('resources/js/app.js') --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</body>

</html>
