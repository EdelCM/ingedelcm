@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">📋 Listado de Personas Registradas</h1>

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Registros de Personas
                    </div>
                    <a href="{{ route('caracterizacion.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Nueva Persona
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesPersonas" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th>Nombre Completo</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>País Nac.</th>
                            <th>Depto. Res.</th>
                            <th>Ciudad Res.</th>
                            <th>Barrio Res.</th>
                            <th>Dirección Res.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personas as $persona)
                            <tr>
                                <td>{{ $persona->tipo_documento }}</td>
                                <td>{{ $persona->numero_documento }}</td>
                                <td>{{ $persona->primer_nombre }} {{ $persona->segundo_nombre }}
                                    {{ $persona->primer_apellido }} {{ $persona->segundo_apellido }}</td>
                                <td>{{ $persona->celular }}</td>
                                <td>{{ $persona->correo }}</td>
                                <td>{{ $persona->paisNacimiento->nombre ?? 'N/A' }}</td>
                                <td>{{ $persona->departamentoResidencia->nombre ?? 'N/A' }}</td>
                                <td>{{ $persona->ciudadResidencia->nombre ?? 'N/A' }}</td>
                                <td>{{ $persona->barrio_residencia }}</td>
                                <td>{{ $persona->direccion_residencia }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="text" placeholder="Filtrar Tipo Doc." class="form-control filter-input" data-column="0"></th>
                            <th><input type="text" placeholder="Filtrar Documento" class="form-control filter-input" data-column="1"></th>
                            <th><input type="text" placeholder="Filtrar Nombre" class="form-control filter-input" data-column="2"></th>
                            <th><input type="text" placeholder="Filtrar Celular" class="form-control filter-input" data-column="3"></th>
                            <th><input type="text" placeholder="Filtrar Correo" class="form-control filter-input" data-column="4"></th>
                            <th><input type="text" placeholder="Filtrar País" class="form-control filter-input" data-column="5"></th>
                            <th><input type="text" placeholder="Filtrar Depto." class="form-control filter-input" data-column="6"></th>
                            <th><input type="text" placeholder="Filtrar Ciudad" class="form-control filter-input" data-column="7"></th>
                            <th><input type="text" placeholder="Filtrar Barrio" class="form-control filter-input" data-column="8"></th>
                            <th><input type="text" placeholder="Filtrar Dirección" class="form-control filter-input" data-column="9"></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dataTables_filter, .dataTables_length {
            margin-bottom: 15px;
        }
        .filter-input {
            width: 100%;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
        }
        table.dataTable thead th {
            border-bottom: 2px solid #e3e6f0;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var table = $('#datatablesPersonas').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        $('input', this.footer()).on('keyup change', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    });
                }
            });

            // Confirmación para eliminar
            $('.btn-danger').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
