<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--FONT AWESOME 5-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <style>
        .container {
            max-width: 1031px;
            margin: 95px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container mb-3">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-custom-secondary"
                onclick="loadContent('{{ route('dashboard') }}', event)">Inicio</a>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center mb-4">Supervisores Activos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre completo</th>
                    <th>DPI</th>
                    <th>Teléfono</th>
                    <th>Correo electrónico</th>
                    <th>Cargo</th>
                    <th>Sexo</th>
                    <th>Acción</th>
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
                        <td>{{ $sup->estado_texto }}</td>
                        <td>

                            <div class="d-flex flex-column gap-2">
                                <a class="btn btn-success btn-sm btn-editar-supervisor" data-id="{{ $sup->id_supervisor }}">
                                    Editar
                                </a>

                                @if($sup->estado)
                                    <a href="{{ route('supervisor.inactivar', $sup->id_supervisor) }}"
                                        class="btn btn-danger btn-sm">
                                        Inactivar
                                    </a>
                                @else
                                    <a href="{{ route('supervisor.activar', $sup->id_supervisor) }}"
                                        class="btn btn-primary btn-sm">
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

    <div class="modal fade" id="supervisorModal" tabindex="-1" aria-labelledby="supervisorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supervisorModalLabel">Editar Supervisor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_supervisor">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="dpi" class="form-label">DPI</label>
                        <input type="text" class="form-control" id="dpi">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo">
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo">
                    </div>
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizar_supervisor">Actualizar</button>
                </div>
            </div>
        </div>
    </div>



    <!--bootstrap ja-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

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