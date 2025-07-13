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

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-5ZTrNQZz3IQB/4nUQZ1qZ1fjc0Mpe2wQKdlL2BGKMFHR8C1OAYC5A6qVbz6yoaAA" crossorigin="anonymous">

    <!-- AOS CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QrKpN5e8fA3XzqETrbsBDVmpS5EOufPgk2PULv08u9mNCMjPQZn8YjeUw6w27U5H" crossorigin="anonymous">
    </script>

    <!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- WOW.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

</body>

</html>
