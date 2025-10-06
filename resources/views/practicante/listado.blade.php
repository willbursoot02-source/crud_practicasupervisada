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
        <div class="d-grid gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary"
                onclick="loadContent('{{ route('dashboard') }}', event)">
                Inicio
            </a>
        </div>
    </div>


    <div class="container">
        <h2 class="text-center mt-4 mb-4">Practicantes Activos</h2>
        <table class="table table-brdered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Institución</th>
                    <th>Carrera</th>
                    <th>Área</th>
                    <th>Acción</th>
                    <th>Acción</th>
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

                                <a class="btn btn-info btn-sm btn-ver" data-id="{{ $sup->id_practicante }}">
                                    Ver
                                </a>

                                @if($sup->estado)
                                    <a href="{{ route('practicante.inactivar', $sup->id_practicante) }}"
                                        class="btn btn-danger btn-sm">
                                        Inactivar
                                    </a>
                                @else
                                    <a href="{{ route('practicante.activar', $sup->id_practicante) }}"
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!--bootstrap ja-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    error: function (err) {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudieron obtener los datos del practicante'
                        });
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
                        id_practicante: id_practicante,
                        nombre: nombre,
                        edades: edades,
                        telefono: telefono,
                        institucion: institucion,
                        carrera: carrera,
                        area: area
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: result.title,
                                text: result.message
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result.title,
                                text: result.message
                            });
                        }
                    },
                    error: function (err) {
                        console.error("Error en la petición:", err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el practicante'
                        });
                    }
                });
            });
        });
    </script>


</body>

</html>