<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Control</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-sm p-4">
                <h2 class="text-center mb-4">Registro de Control</h2>

                <div class="row g-3">
                    <div class="mb-3">
                        <label for="practicante" class="form-label">Practicante</label>
                        <select name="id_practicante" id="id_practicante" class="form-select" required>
                            <option value="">Seleccione</option>
                            @foreach($practicantes as $practicante)
                                <option value="{{ $practicante->id_practicante }}">
                                    {{ $practicante->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="supervisor" class="form-label">Supervisor</label>
                        <select name="id_supervisor" id="id_supervisor" class="form-select" required>
                            <option value="">Seleccione</option>
                            @foreach($supervisores as $supervisor)
                                <option value="{{ $supervisor->id_supervisor }}">
                                    {{ $supervisor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>

                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                    </div>

                    <div class="text-center">
                        <a type="button" id="btn_guardar" class="btn btn-primary px-5">Guardar</a>

                        <a href="{{ route('dashboard') }}" type="button" id="btn_retornar" class="btn btn-danger px-5"
                            onclick="loadContent('{{ route('dashboard') }}', event)">
                            Cancelar
                        </a>

                    </div>
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
            //test
            console.log('Hola prueba');
            console.log($('#id_practicante').val());
            console.log($('#id_supervisor').val());

            var id_practicante = $('#id_practicante').val();
            var id_supervisor = $('#id_supervisor').val();
            var fecha = $('#fecha').val();
            var comentario = $('#comentario').val();

            $.ajax({
                url: "{{ route('control.guardar') }}",
                type: 'POST',
                data: {
                    id_supervisor: id_supervisor,
                    id_practicante: id_practicante,
                    fecha: fecha,
                    comentario: comentario
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