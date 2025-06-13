@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/caracterizacion.css') }}">

<a href="{{ url('/') }}" class="btn-regresar">
    ← Regresar a la Página Principal
</a>

<div class="form-container">
    <h2>🧾 Registro de Caracterización</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('caracterizacion.store') }}" method="POST">
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

            <label for="numero_documento">Número de documento*</label>
            <input type="text" name="numero_documento" id="numero_documento"
                placeholder="Ej: 123456789" required
                pattern="^\d{7,13}$" minlength="7" maxlength="13"
                title="Debe contener solo números entre 7 y 13 dígitos">


            <input name="primer_nombre" placeholder="Primer nombre" required>
            <input name="segundo_nombre" placeholder="Segundo nombre">
            <input name="primer_apellido" placeholder="Primer apellido" required>
            <input name="segundo_apellido" placeholder="Segundo apellido">

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

        <button type="submit">📤 Registrar</button>

        <!--Agrega un botón para ir al formulario de establecimiento comercial-->
        <div style="margin-top: 1.5rem;">
            <a href="{{ route('caracterizacion.establecimiento.create') }}" class="btn-registro">
                ➕ Registrar Establecimiento Comercial
            </a>
        </div>

    </form>
</div>
@endsection
