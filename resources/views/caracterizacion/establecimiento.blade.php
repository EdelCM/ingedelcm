@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<a href="{{ url('/') }}" class="btn-regresar">← Regresar a la Página Principal</a>

<div class="form-container">
    <h2>🏪 Registro de Establecimiento Comercial</h2>

    <form action="{{ route('caracterizacion.establecimiento.store') }}" method="POST">
        @csrf

        <label for="persona_id">ID de la persona</label>
        <input type="number" name="persona_id" required>

        <label for="nombre_establecimiento">Nombre del establecimiento</label>
        <input type="text" name="nombre_establecimiento" required>

        <label for="tipo_establecimiento">Tipo</label>
        <input type="text" name="tipo_establecimiento" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <label for="telefono_contacto">Teléfono</label>
        <input type="text" name="telefono_contacto">

        <label for="email_contacto">Correo</label>
        <input type="email" name="email_contacto">

        <button type="submit">📤 Registrar Establecimiento</button>
    </form>
</div>
@endsection
