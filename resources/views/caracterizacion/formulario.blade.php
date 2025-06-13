@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/caracterizacion.css') }}">

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
            <input name="tipo_documento" placeholder="Tipo de documento" required>
            <input name="numero_documento" placeholder="Número de documento" required>
            <input name="primer_nombre" placeholder="Primer nombre" required>
            <input name="segundo_nombre" placeholder="Segundo nombre">
            <input name="primer_apellido" placeholder="Primer apellido" required>
            <input name="segundo_apellido" placeholder="Segundo apellido">
            <input name="celular" placeholder="Celular" required>
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

        <fieldset>
            <legend>🏪 Establecimiento Comercial</legend>
            <input name="nombre_establecimiento" placeholder="Nombre del establecimiento" required>
            <input name="tipo_establecimiento" placeholder="Tipo (tienda, panadería, etc.)" required>
            <input name="ciudad_establecimiento" placeholder="Ciudad" required>
            <input name="direccion_establecimiento" placeholder="Dirección" required>
            <input name="telefono_establecimiento" placeholder="Teléfono">
            <input name="email_establecimiento" placeholder="Correo">
        </fieldset>

        <button type="submit">📤 Registrar</button>
    </form>
</div>
@endsection
