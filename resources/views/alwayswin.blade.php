@extends('layouts.app')

@section('title', 'Always Win - Juego de Azar')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/alwayswin.css') }}">
@endsection

@section('content')
<a href="{{ url('/') }}" class="btn-volver">
  ← Regresar a la Página Principal
</a>
<div class="contenedor">
    <header>
        <h1>Acierta el Número</h1>
        <p class="instrucciones">Cada jugador debe seleccionar un número único entre 0 y 9. ¡El que acierte al número ganador gana!</p>
    </header>

    <main>
        <div class="jugadores-container" id="jugadoresContainer"></div>

        <div class="controles">
            <button id="iniciarJuego" class="boton-primario">Iniciar Juego</button>
            <button id="reiniciarJuego" class="boton-secundario">Reiniciar</button>
        </div>

        <div class="resultado" id="resultadoContainer">
            <h2>Resultado</h2>
            <div id="resultadoTexto"></div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/alwayswin-api.js') }}"></script>
<script src="{{ asset('js/alwayswin-logica.js') }}"></script>
@endsection
