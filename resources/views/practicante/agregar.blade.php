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

<body>

    <style>
        .container {
            max-width: 800px;
            margin: 80px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }
    </style>


    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <h2 class="text-center mb-4">Registro Practicante</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="text" class="form-control" id="edades" name="edades">
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="col-md-6">
                    <label for="institucion" class="form-label">Institución educativa</label>
                    <input type="text" class="form-control" id="institucion" name="institucion">
                </div>
                <div class="col-md-6">
                    <label for="carrera" class="form-label">Carrera</label>
                    <input type="text" class="form-control" id="carrera" name="carrera">
                </div>
                <div class="col-md-6">
                    <label for="area" class="form-label">Área asignada</label>
                    <input type="text" class="form-control" id="area" name="area">
                </div>
                <div class="col-12 text-center mt-4">
                    <a id="btn_completar" class="btn btn-primary px-4">Guardar</a>
                    <a href="{{ route('dashboard') }}" type="button" id="btn_retornar" class="btn btn-danger px-5"
                        onclick="loadContent('{{ route('dashboard') }}', event)">
                        Cancelar
                    </a>
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
        $('#btn_completar').click(function () {
            var nombre = $('#nombre').val();
            var edades = $('#edades').val();
            var telefono = $('#telefono').val();
            var institucion = $('#institucion').val();
            var carrera = $('#carrera').val();
            var area = $('#area').val();

            $.ajax({
                url: "{{ route('practicante.guardar') }}",
                type: 'POST',
                data: {
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
                },
            });
        });
    </script>

</body>

</html>