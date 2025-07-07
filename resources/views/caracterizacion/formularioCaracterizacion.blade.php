@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/caracterizacion.css') }}">

    <a href="{{ url('/') }}" class="btn-regresar">
        ← Regresar a la Página Principal
    </a>

    <div class="form-container">
        <h2 class="form-titulo">🧾 Registro de Caracterización</h2>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('caracterizacion.store') }}" method="POST" id="formCaracterizacion">
            @csrf

            <fieldset>
                <legend>📄 Datos de la Persona</legend>

                <label for="tipo_documento">Tipo de documento:</label>
                <select name="tipo_documento" id="tipo_documento" required>
                    @foreach ($tipos_documento as $tipo)
                        <option value="{{ $tipo->nombre }}" {{ $tipo->nombre == 'Cédula de Ciudadanía' ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>

                <label for="numero_documento">Número de documento *</label>
                <input type="text" name="numero_documento" id="numero_documento" required pattern="[0-9]{7,13}"
                    title="Solo números entre 7 y 13 dígitos" maxlength="13" inputmode="numeric" placeholder="Ej: 1234567">

                <label for="primer_nombre">Primer Nombre *</label>
                <input type="text" name="primer_nombre" id="primer_nombre" required pattern="[A-ZÁÉÍÓÚÑ\s]+"
                    title="Solo letras en mayúsculas" style="text-transform: uppercase">

                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" name="segundo_nombre" id="segundo_nombre" pattern="[A-ZÁÉÍÓÚÑ ]+"
                    title="Solo letras en mayúsculas">

                <label for="primer_apellido">Primer Apellido *</label>
                <input type="text" name="primer_apellido" id="primer_apellido" pattern="[A-ZÁÉÍÓÚÑ\s]+"
                    title="Solo letras en mayúsculas" style="text-transform: uppercase">

                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" name="segundo_apellido" id="segundo_apellido" pattern="[A-ZÁÉÍÓÚÑ\s]+"
                    title="Solo letras en mayúsculas" style="text-transform: uppercase">

                <label for="celular">Celular*</label>
                <input type="text" name="celular" id="celular" placeholder="Ej: 3001234567" required
                    pattern="^\d{7,13}$" minlength="7" maxlength="13"
                    title="Debe contener solo números entre 7 y 13 dígitos">


                <input name="correo" placeholder="Correo">
                <input name="fecha_nacimiento" type="date">

                <label for="pais_nacimiento">País de nacimiento *</label>
                <select name="pais_nacimiento" id="pais_nacimiento" required>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}" {{ $pais->nombre == 'Colombia' ? 'selected' : '' }}>
                            {{ $pais->nombre }}
                        </option>
                    @endforeach
                </select>

                <label for="departamento_nacimiento">Departamento de nacimiento *</label>
                <select name="departamento_nacimiento" id="departamento_nacimiento" required>
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        @if ($departamento->pais_id == $paisDefault->id)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="ciudad_nacimiento">Ciudad de nacimiento *</label>
                <select name="ciudad_nacimiento" id="ciudad_nacimiento" required>
                    <option value="">Seleccione una ciudad</option>
                </select>
                <label for="departamento_residencia">Departamento de residencia *</label>
                <select name="departamento_residencia" id="departamento_residencia" required>
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>

                <label for="ciudad_residencia">Ciudad de residencia *</label>
                <select name="ciudad_residencia" id="ciudad_residencia" required disabled>
                    <option value="">Seleccione una ciudad</option>
                </select>

                <input name="barrio_residencia" placeholder="Barrio" required>
                <input name="direccion_residencia" placeholder="Dirección" required>
            </fieldset>

            <div class="centrado">
                <button type="submit" class="btn-enviar">📤 Registrar</button>
            </div>

            <!--Agrega un botón para ir al formulario de establecimiento comercial-->
            <div style="margin-top: 1.5rem;">
                <a href="{{ route('caracterizacion.establecimiento.create') }}" class="btn-registro">
                    ➕ Registrar Establecimiento Comercial
                </a>
            </div>

        </form>

        <!-- Botón para ir al listado de personas -->
        <div style="margin-top: 1.5rem;">
            <a href="{{ route('personas.index') }}" class="btn btn-primary">
                📋 Ver Listado de Personas Registradas
            </a>
        </div>

    </div>

    <!-- JS personalizado -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ✅ SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Archivo para alertas y popup -->
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script src="{{ asset('js/validaciones.js') }}"></script>
@endsection
