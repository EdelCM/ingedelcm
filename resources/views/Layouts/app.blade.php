<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ingedelcm')</title>

    @if (session()->has('swal-success'))
        <meta name="swal-success" content="{{ session('swal-success') }}">
    @endif

    @if (session()->has('swal-error'))
        <meta name="swal-error" content="{{ session('swal-error') }}">
    @endif


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('styles')
</head>

<body>

    @yield('content')

    <!-- Scripts base -->
    <!-- jQuery necesario para validaciones.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')

</body>

</html>
