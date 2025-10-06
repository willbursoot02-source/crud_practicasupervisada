<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Supervisores</title>
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

        <h2 class="text-center mb-4">Supervisores Activos</h2>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
                        <th>DPI</th>
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Cargo</th>
                        <th>Sexo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supervisores as $sup)
                        <tr>
                            <td>{{ $sup->nombre }}</td>
                            <td>{{ $sup->cui }}</td>
                            <td>{{ $sup->telefono }}</td>
                            <td>{{ $sup->correo }}</td>
                            <td>{{ $sup->cargo }}</td>
                            <td>{{ $sup->sexo }}</td>
                            <td>{{ $sup->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <a class="btn btn-custom-primary btn-sm btn-editar-supervisor"
                                        data-id="{{ $sup->id_supervisor }}">
                                        <span class="material-symbols-outlined">edit</span> Editar
                                    </a>

                                    @if($sup->estado)
                                        <a href="{{ route('supervisor.inactivar', $sup->id_supervisor) }}"
                                            class="btn btn-danger btn-sm">
                                            Inactivar
                                        </a>
                                    @else
                                        <a href="{{ route('supervisor.activar', $sup->id_supervisor) }}"
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.btn-editar-supervisor').click(function () {
                var id = $(this).data('id');

                $.ajax({
                    url: '/supervisor/datos/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#id_supervisor').val(data.id_supervisor);
                        $('#nombre').val(data.nombre);
                        $('#dpi').val(data.cui);
                        $('#telefono').val(data.telefono);
                        $('#correo').val(data.correo);
                        $('#cargo').val(data.cargo);
                        $('#sexo').val(data.sexo);

                        var modal = new bootstrap.Modal(document.getElementById('supervisorModal'));
                        modal.show();

                        document.getElementById('supervisorModal').addEventListener('shown.bs.modal', function () {
                            $('#nombre').focus();
                        }, { once: true });
                    },
                    error: function () {
                        Swal.fire('Error', 'No se pudieron obtener los datos del supervisor', 'error');
                    }
                });
            });

            $('#actualizar_supervisor').click(function () {
                var id_supervisor = $('#id_supervisor').val();
                var nombre = $('#nombre').val();
                var dpi = $('#dpi').val();
                var telefono = $('#telefono').val();
                var correo = $('#correo').val();
                var cargo = $('#cargo').val();
                var sexo = $('#sexo').val();

                $.ajax({
                    url: '/supervisor/guardar',
                    type: 'POST',
                    data: {
                        id_supervisor: id_supervisor,
                        nombre: nombre,
                        dpi: dpi,
                        telefono: telefono,
                        correo: correo,
                        cargo: cargo,
                        sexo: sexo
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
                        Swal.fire('Error', 'No se pudo actualizar el supervisor', 'error');
                    }
                });
            });
        });
    </script>

</body>

</html>