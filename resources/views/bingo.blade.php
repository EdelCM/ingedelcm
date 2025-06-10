@extends('layouts.app')

@section('title', 'Generador de Cartones de Bingo')

@section('content')
<div class="text-center mt-3">
    <a href="{{ url('/') }}" class="btn btn-back">⬅ Regresar a la Página Principal</a>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">🎲 Generador de Cartón de Bingo</h1>
    <div class="text-center mb-4">
        <button id="generateRandomCard" class="btn btn-primary mr-2">Generar Cartón Aleatorio</button>
        <button id="generateEmptyCard" class="btn btn-secondary mr-2">Crear Cartón Personalizado</button>
        <button id="exportPDF" class="btn btn-success">Exportar a PDF</button>
    </div>
    <div id="bingoCardContainer" class="d-flex justify-content-center"></div>
</div>
@endsection

@section('scripts')
    <!-- jQuery y librerías necesarias -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>window.jsPDF = window.jspdf.jsPDF;</script>
    <script src="{{ asset('js/bingo.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/bingo.css') }}">
@endsection
