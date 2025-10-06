<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agregar</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--FONT AWESOME 5-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<html>

<body>

    <style>

    </style>

    <body>
        <div class="container mt-5 py-5 justify-content-center shadow">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h4>Consulta de DPI</h4>
                        </div>
                        <div class="card-body">
                            <form id="formdpi">
                                <div class="mb-3">
                                    <label for="dpi" class="form-label">Ingrese su DPI</label>
                                    <input type="text" class="form-control" id="dpi" name="dpi" placeholder="DPI">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success w-100">Consultar</button>
                                    <a href="{{ route('dashboard') }}" type="button" id="btn_retornar"
                                        class="btn btn-danger px-5"
                                        onclick="loadContent('{{ route('dashboard') }}', event)">
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card mt-4 shadow-sm" id="resultadocard" style="display: none;">
                        <div class="card-header bg-success text-white">
                            <h5>Datos del DPI</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nombre:</strong> <span id="nombre">-</span></p>
                            <p><strong>Telefono:</strong> <span id="telefono">-</span></p>
                            <p><strong>Correo electrónico:</strong> <span id="correo">-</span></p>
                            <p><strong> Cargo:</strong> <span id="cargo">-</span></p>
                            <p><strong> Sexo:</strong> <span id="sexo">-</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--bootstrap ja-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            $(document).ready(function () {
                $('#formdpi').submit(function (e) {
                    e.preventDefault();

                    var dpi = $('#dpi').val();

                    if (dpi.trim() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Campo vacío',
                            text: 'Por favor ingrese un DPI válido.'
                        });
                        return;
                    }

                    $.ajax({
                        url: "{{ route('consulta.dpi') }}",
                        type: 'POST',
                        data: { dpi: dpi },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (result) {
                            if (result.success) {
                                $('#resultadocard').show();
                                $('#nombre').text(result.data.nombre);
                                $('#telefono').text(result.data.telefono);
                                $('#correo').text(result.data.correo);
                                $('#cargo').text(result.data.cargo);
                                $('#sexo').text(result.data.sexo);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: result.title ?? 'No encontrado',
                                    text: result.message ?? 'No se encontraron datos con ese DPI.'
                                });
                                $('#resultadocard').hide();
                            }
                        },
                        error: function (err) {
                            console.error("Error en la petición:", err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de servidor',
                                text: 'Ocurrió un problema al procesar la consulta.'
                            });
                        },
                    });
                });
            });


        </script>

    </body>

</html>