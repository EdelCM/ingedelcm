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
                <label for="nit_establecimiento">NIT del Establecimiento *</label>
                <input type="text" name="nit_establecimiento" required maxlength="20" placeholder="Ejemplo: 123456789-0"
                    title="Formato: 5-10 números, guion y 1 dígito verificador">
                <small class="form-text text-muted">Formato: 123456789-0 (solo números y un guion)</small>
            </div>

            <div class="campo-form">
                <label for="nombre_establecimiento">Nombre del Establecimiento *</label>
                <input type="text" name="nombre_establecimiento" required maxlength="100"
                    placeholder="Ejemplo COMERCIAL S.A." title="Solo letras mayúsculas, números y los símbolos . , -">
                <small class="form-text text-muted">Solo mayúsculas, números y los símbolos . , -</small>
            </div>

            <div class="campo-form">
                <label for="tipo_establecimiento">Tipo Establecimiento *</label>
                <input type="text" name="tipo_establecimiento" required maxlength="50" placeholder="Ejemplo RESTAURANTE"
                    title="Solo letras mayúsculas y espacios">
                <small class="form-text text-muted">Solo letras mayúsculas y espacios</small>
            </div>

            <div class="campo-form">
                <label for="departamento_id">Departamento *</label>
                <select name="departamento_id" id="departamento_establecimiento" required>
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        @if ($departamento->pais_id == $paisDefault->id)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="campo-form">
                <label for="ciudad_id">Ciudad *</label>
                <select name="ciudad_id" id="ciudad_establecimiento" required disabled>
                    <option value="">Seleccione una ciudad</option>
                </select>
            </div>

            <div class="campo-form">
                <label for="direccion">Dirección *</label>
                <input type="text" name="direccion" placeholder="Dirección" required>
            </div>

            <div class="campo-form">
                <label for="telefono_contacto">Teléfono *</label>
                <input type="text" name="telefono_contacto" id="telefono_contacto" placeholder="Ej: 3001234567"
                    pattern="^\d{7,13}$" minlength="7" maxlength="13"
                    title="Debe contener solo números entre 7 y 13 dígitos">
                <small class="form-text text-muted">Solo números, entre 7 y 10 dígitos.</small>
            </div>

            <div class="campo-form">
                <label for="email_contacto">Correo *</label>
                <input type="email" name="email_contacto" maxlength="100" placeholder="Correo: Email@gmail.com">
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
