@extends('layouts.app')

@section('content')
    <a href="{{ route('caracterizacion.create') }}" class="btn-regresar">
        ← Regresar al Registro de Caracterización
    </a>
    <h2 class="form-titulo">📋 Listado de Personas Registradas</h2>


    <form method="GET" action="{{ route('personas.index') }}" class="filtro-box">
        <input type="text" name="search" placeholder="Buscar por nombre, documento o celular"
            value="{{ request('search') }}">
        <select name="perPage">
            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
        </select>
        <button type="submit">🔍 Buscar</button>
    </form>

    <table class="tabla-estilo">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre Completo</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($personas as $persona)
                <tr>
                    <td>{{ $persona->numero_documento }}</td>
                    <td>{{ $persona->primer_nombre }} {{ $persona->segundo_nombre }} {{ $persona->primer_apellido }}
                        {{ $persona->segundo_apellido }}</td>
                    <td>{{ $persona->celular }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>
                        <!-- Espacios para funciones futuras -->
                        <button disabled>✏️ Actualizar</button>
                        <button disabled>🗑️ Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $personas->appends(request()->all())->links() }}
@endsection
