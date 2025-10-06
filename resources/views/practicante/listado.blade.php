<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Practicantes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background: linear-gradient(135deg, #141e30, #243b55);
            min-height: 100vh;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-custom {
            background-color: #ffffff;
            color: #333;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        .table thead {
            background: linear-gradient(135deg, #141e30, #243b55);
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #d9e1f2;
        }

        .btn-custom-primary {
            background-color: #141e30;
            color: #fff;
            border-radius: 8px;
        }

        .btn-custom-primary:hover {
            background-color: #1b2a45;
            color: #fff;
        }

        .btn-custom-secondary {
            background-color: #6c757d;
            color: #fff;
            border-radius: 8px;
        }

        .btn-custom-secondary:hover {
            background-color: #5a6268;
            color: #fff;
        }

        .btn-group-vertical .btn {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container container-custom mb-4">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-custom-secondary">Inicio</a>
        </div>

        <h2 class="text-center mb-4">Practicantes Activos</h2>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th>Institución</th>
                        <th>Carrera</th>
                        <th>Área</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($practicante as $sup)
                        <tr>
                            <td>{{ $sup->nombre }}</td>
                            <td>{{ $sup->edad }}</td>
                            <td>{{ $sup->telefono }}</td>
                            <td>{{ $sup->institucion }}</td>
                            <td>{{ $sup->carrera }}</td>
                            <td>{{ $sup->area }}</td>
                            <td>{{ $sup->estado_texto }}</td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <a class="btn btn-custom-primary btn-sm btn-ver" data-id="{{ $sup->id_practicante }}">
                                        <span class="material-symbols-outlined">edit</span> Editar
                                    </a>


                                    @if($sup->estado)
                                        <a href="{{ route('practicante.inactivar', $sup->id_practicante) }}"
                                            class="btn btn-danger btn-sm">
                                            Inactivar
                                        </a>
                                    @else
                                        <a href="{{ route('practicante.activar', $sup->id_practicante) }}"
                                            class="btn btn-success btn-sm">
                                            Activar
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="practicanteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Practicante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_practicante">
                    <div class="mb-2">
                        <label>Nombre</label>
                        <input type="text" id="nombre" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Edad</label>
                        <input type="text" id="edades" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Teléfono</label>
                        <input type="text" id="telefono" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Institución</label>
                        <input type="text" id="institucion" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Carrera</label>
                        <input type="text" id="carrera" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Área</label>
                        <input type="text" id="area" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="actualizar_estudiante" class="btn btn-success">Actualizar</button>
                    <button type="button" class="btn btn-custom-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.btn-ver').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    url: '/practicante/datos/actualizar/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#id_practicante').val(data.id_practicante ?? data.id);
                        $('#nombre').val(data.nombre);
                        $('#edades').val(data.edad);
                        $('#telefono').val(data.telefono);
                        $('#institucion').val(data.institucion);
                        $('#carrera').val(data.carrera);
                        $('#area').val(data.area);

                        var modal = new bootstrap.Modal(document.getElementById('practicanteModal'));
                        modal.show();

                        document.getElementById('practicanteModal').addEventListener('shown.bs.modal', function () {
                            $('#nombre').focus();
                        }, { once: true });
                    },
                    error: function () {
                        Swal.fire('Error', 'No se pudieron obtener los datos del practicante', 'error');
                    }
                });
            });

            $('#actualizar_estudiante').click(function () {
                var id_practicante = $('#id_practicante').val();
                var nombre = $('#nombre').val();
                var edades = $('#edades').val();
                var telefono = $('#telefono').val();
                var institucion = $('#institucion').val();
                var carrera = $('#carrera').val();
                var area = $('#area').val();

                $.ajax({
                    url: '/practicante/guardar',
                    type: 'POST',
                    data: {
                        id_practicante, nombre, edades, telefono, institucion, carrera, area
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(result.title, result.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire(result.title, result.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'No se pudo actualizar el practicante', 'error');
                    }
                });
            });
        });
    </script>
</body>

</html>