<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ingedelcm')</title>

    @if (session('success'))
        <meta name="swal-success" content="{{ session('success') }}">
    @endif

    @if (session('error'))
        <meta name="swal-error" content="{{ session('error') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('styles')
</head>

<body>

    @yield('content')
    @yield('styles')
    @yield('scripts')



</body>

</html>
