@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<a href="{{ url('/') }}" class="btn-regresar">← Regresar a la Página Principal</a>

<div class="formulario-contenedor">
    <h2 class="form-titulo">🏪 Registro de Establecimiento Comercial</h2>

    <form action="{{ route('caracterizacion.establecimiento.store') }}" method="POST" class="formulario-box">
        @csrf

        <div class="campo-form">
            <label for="persona_id">ID de la persona</label>
            <input type="number" name="persona_id" required>
        </div>

        <div class="campo-form">
            <label for="nombre_establecimiento">Nombre del establecimiento</label>
            <input type="text" name="nombre_establecimiento" required>
        </div>

        <div class="campo-form">
            <label for="tipo_establecimiento">Tipo</label>
            <input type="text" name="tipo_establecimiento" required>
        </div>

        <div class="campo-form">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" required>
        </div>

        <div class="campo-form">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" required>
        </div>

        <div class="campo-form">
            <label for="telefono_contacto">Teléfono</label>
            <input type="text" name="telefono_contacto">
        </div>

        <div class="campo-form">
            <label for="email_contacto">Correo</label>
            <input type="email" name="email_contacto">
        </div>

        <div class="campo-form centrado">
            <button type="submit" class="btn-enviar">📤 Registrar Establecimiento</button>
        </div>
    </form>
</div>
@endsection
