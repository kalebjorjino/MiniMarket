<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- TAB/FAVICON/TITLE -->
    <title>{{ config('app.name', 'SAMJ Korean Mini-mart') }}</title>

    <link rel="icon" href="{{ URL::asset('images/favicon.png') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Sheet -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css'])

</head>
<body>

    <div id="app" class="row g-0 auth-row vh-100">
        @yield('content')
    </div>

    <!-- ========= All Javascript files linkup ======== -->
    {{-- Custom Script --}}
    <script src="{{ asset('js/main.js') }}"></script>
    
    @vite('resources/js/app.js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</body>

</html>