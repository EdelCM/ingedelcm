@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/caracterizacion.css') }}">

<a href="{{ url('/') }}" class="btn-regresar">
    ← Regresar a la Página Principal
</a>

<div class="form-container">
    <h2 class="form-titulo">🧾 Registro de Caracterización</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('caracterizacion.store') }}" method="POST" id="formCaracterizacion">
        @csrf

        <fieldset>
            <legend>📄 Datos de la Persona</legend>

            <label for="tipo_documento">Tipo de documento:</label>
            <select name="tipo_documento" id="tipo_documento" required>
                @foreach($tipos_documento as $tipo)
                    <option value="{{ $tipo->nombre }}" {{ $tipo->nombre == 'Cédula de Ciudadanía' ? 'selected' : '' }}>
                    {{ $tipo->nombre }}
                    </option>
                @endforeach
            </select>

                <label for="numero_documento">Número de documento *</label>
                <input type="text" name="numero_documento" id="numero_documento" required pattern="[0-9]{7,13}" title="Solo números entre 7 y 13 dígitos" maxlength="13" inputmode="numeric" placeholder="Ej: 123456789">

                <label for="primer_nombre">Primer Nombre *</label>
                <input type="text" name="primer_nombre" id="primer_nombre" required pattern="[A-ZÁÉÍÓÚÑ ]+" title="Solo letras en mayúsculas">

                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" name="segundo_nombre" id="segundo_nombre" pattern="[A-ZÁÉÍÓÚÑ ]+" title="Solo letras en mayúsculas">

                <label for="primer_apellido">Primer Apellido *</label>
                <input type="text" name="primer_apellido" id="primer_apellido" required pattern="[A-ZÁÉÍÓÚÑ ]+" title="Solo letras en mayúsculas">

                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" name="segundo_apellido" id="segundo_apellido" pattern="[A-ZÁÉÍÓÚÑ ]+" title="Solo letras en mayúsculas">

            <label for="celular">Celular*</label>
            <input type="text" name="celular" id="celular"
                placeholder="Ej: 3001234567" required
                pattern="^\d{7,13}$" minlength="7" maxlength="13"
                title="Debe contener solo números entre 7 y 13 dígitos">


            <input name="correo" placeholder="Correo">
            <input name="fecha_nacimiento" type="date">
            <input name="pais_nacimiento" placeholder="País" value="Colombia" required>
            <input name="departamento_nacimiento" placeholder="Departamento nacimiento" required>
            <input name="ciudad_nacimiento" placeholder="Ciudad nacimiento" required>
            <input name="departamento_residencia" placeholder="Departamento residencia" required>
            <input name="ciudad_residencia" placeholder="Ciudad residencia" required>
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
</div>

<!-- JS personalizado -->
<script src="{{ asset('js/validaciones.js') }}"></script>
@endsection
