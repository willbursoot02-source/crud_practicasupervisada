{{-- resources/views/supervisor/agregar.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Supervisor</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Material Symbols -->
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
            <h2 class="text-center mb-4">Registro de Supervisor</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-6">
                    <label class="form-label">DPI</label>
                    <input type="text" class="form-control" id="cui" name="cui">
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="col-md-6">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control" id="correo" name="correo">
                </div>
                <div class="col-md-6">
                    <label for="carrera" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargo" name="cargo">
                </div>
                <div class="col-md-6">
                    <label for="genero">Género</label>
                    <select name="genero" id="sexo" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero }}">{{ $genero }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 text-center mt-4">
                    <a id="btn_guardar" class="btn btn-primary px-4">Guardar</a>
                    <a href="{{ route('dashboard') }}" type="button" id="btn_retornar" class="btn btn-danger px-5"
                        onclick="loadContent('{{ route('dashboard') }}', event)">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#btn_guardar').click(function () {
            var nombre = $('#nombre').val();
            var cui = $('#cui').val();
            var telefono = $('#telefono').val();
            var correo = $('#correo').val();
            var cargo = $('#cargo').val();
            var sexo = $('#sexo').val();

            $.ajax({
                url: "{{ route('supervisor.guardar') }}",
                type: 'POST',
                data: {
                    nombre: nombre,
                    cui: cui,
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