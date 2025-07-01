@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <a href="{{ url('/') }}" class="btn-regresar">← Regresar a la Página Principal</a>

    <div class="formulario-contenedor">
        <h2 class="form-titulo">🏪 Registro de Establecimiento Comercial</h2>

        <!--Validaciones -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('caracterizacion.establecimiento.store') }}" method="POST" class="formulario-box">
            @csrf

            {{-- Datos del establecimiento --}}
            <div class="campo-form">
                <label for="nit_establecimiento">NIT del Establecimiento</label>
                <input type="text" name="nit_establecimiento" required maxlength="20" placeholder="Ejemplo: 123456789-0"
                    title="Formato: 5-10 números, guion y 1 dígito verificador">
                <small class="form-text text-muted">Formato: 123456789-0 (solo números y un guion)</small>
            </div>

            <div class="campo-form">
                <label for="nombre_establecimiento">Nombre del Establecimiento</label>
                <input type="text" name="nombre_establecimiento" required maxlength="100">
            </div>

            <div class="campo-form">
                <label for="tipo_establecimiento">Tipo Establecimiento</label>
                <input type="text" name="tipo_establecimiento" required maxlength="50">
            </div>

            <div class="campo-form">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" required maxlength="50">
            </div>

            <div class="campo-form">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" required>
            </div>

            <div class="campo-form">
                <label for="telefono_contacto">Teléfono</label>
                <input type="text" name="telefono_contacto" maxlength="20">
            </div>

            <div class="campo-form">
                <label for="email_contacto">Correo</label>
                <input type="email" name="email_contacto" maxlength="100">
            </div>

            <div class="campo-form centrado">
                <button type="submit" class="btn-enviar">📤 Registrar Establecimiento</button>
            </div>
        </form>
    </div>

@endsection
@push('scripts')
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Archivos de lógica -->
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
@endpush
