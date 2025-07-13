@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/eltoqueg.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <div class="hero-section text-center">
        <img src="{{ asset('pictures/Logo El toque G.png') }}" alt="Logo EL TOQUE G">
        <h1 class="animate__animated animate__fadeInDown">Vive tu Fantasía. Sin Límites. Sin Juicios.</h1>
        <p class="lead animate__animated animate__fadeInUp">
            Contacta modelos exclusivas y verificadas. Tu privacidad es sagrada. El deseo, el arte y la conexión ahora
            tienen un nuevo hogar.
        </p>
        <a href="{{ url('/register') }}" class="btn-register-now animate__animated animate__pulse">
            Regístrate Ahora
        </a>
    </div>

    {{-- Carrusel Horizontal con Texto + Imagen --}}
    <div id="carouselToqueG" class="carousel-horizontal">
        <div class="carousel-item">
            <div class="text-container">
                <h5>Discreción. Elegancia. Deseo.</h5>
                <p>Una experiencia visual y sensorial solo para ti.</p>
            </div>
            <img src="{{ asset('pictures/eltoquegimg/banner1.jpg') }}" alt="Modelo 1">
        </div>
        <div class="carousel-item">
            <div class="text-container">
                <h5>Conexiones privadas</h5>
                <p>Modelos reales. Conversaciones reales. Privacidad real.</p>
            </div>
            <img src="{{ asset('pictures/eltoquegimg/banner2.jpg') }}" alt="Modelo 2">
        </div>
        <div class="carousel-item">
            <div class="text-container">
                <h5>Vívelo. Siéntelo. Compártelo.</h5>
                <p>Tu mundo íntimo, libre de juicios.</p>
            </div>
            <img src="{{ asset('pictures/eltoquegimg/banner3.jpg') }}" alt="Ambiente sensual">
        </div>
    </div>

    {{-- Features --}}
    <div class="features">
        <div class="feature-box animate__animated animate__zoomIn">
            <h3>🧑‍🎤 Creador de Contenido</h3>
            <p>Sube fotos, videos, historias, conecta con tu audiencia y hazte notar.</p>
        </div>
        <div class="feature-box animate__animated animate__zoomIn animate__delay-1s">
            <h3>📷 Historias 24/48h</h3>
            <p>Comparte momentos efímeros o hazlos durar según tu deseo.</p>
        </div>
        <div class="feature-box animate__animated animate__zoomIn animate__delay-2s">
            <h3>💬 Chats Privados</h3>
            <p>Conversa, conecta e interactúa con otros usuarios sin filtros.</p>
        </div>
        <div class="feature-box animate__animated animate__zoomIn animate__delay-3s">
            <h3>🔐 Publicaciones temporales</h3>
            <p>Decide si tu contenido es eterno... o solo por una noche.</p>
        </div>
    </div>

    {{-- Botón de regreso --}}
    <div class="text-center">
        <a href="{{ url('/') }}" class="btn-regresar-dark">
            ← Regresar a la Página Principal
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
