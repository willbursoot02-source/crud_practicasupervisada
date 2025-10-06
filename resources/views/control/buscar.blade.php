<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de DPI</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background: linear-gradient(135deg, #141e30, #243b55);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .card-header {
            background: linear-gradient(135deg, #2171B5, #141e30);
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            background-color: #ffffff;
            color: #333;
            padding: 25px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            border: none;
            border-radius: 10px;
            transition: transform 0.2s ease;
        }

        .btn-success:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #34d058, #218838);
        }

        .btn-danger {
            border-radius: 10px;
            transition: transform 0.2s ease;
        }

        .btn-danger:hover {
            transform: scale(1.03);
        }

        #resultadocard {
            display: none;
            background: #f8f9fa;
        }

        #resultadocard .card-header {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }

        #resultadocard p {
            margin-bottom: 8px;
            font-size: 16px;
        }

        #resultadocard strong {
            color: #141e30;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 90vh;">
        <div class="col-md-6">

            <div class="card shadow-lg mb-4">
                <div class="card-header">
                    <h4><span class="material-symbols-outlined align-middle">badge</span> Consulta de DPI</h4>
                </div>
                <div class="card-body">
                    <form id="formdpi">
                        <div class="mb-3">
                            <label for="dpi" class="form-label">Ingrese su DPI</label>
                            <input type="text" class="form-control" id="dpi" name="dpi"
                                placeholder="Ejemplo: 1234567890101">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success w-100">
                                <span class="material-symbols-outlined align-middle">search</span> Consultar
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger w-100 mt-2"
                                onclick="loadContent('{{ route('dashboard') }}', event)">
                                <span class="material-symbols-outlined align-middle">cancel</span> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg" id="resultadocard">
                <div class="card-header text-center">
                    <h5><span class="material-symbols-outlined align-middle">person_search</span> Datos del DPI</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <span id="nombre">-</span></p>
                    <p><strong>Teléfono:</strong> <span id="telefono">-</span></p>
                    <p><strong>Correo electrónico:</strong> <span id="correo">-</span></p>
                    <p><strong>Cargo:</strong> <span id="cargo">-</span></p>
                    <p><strong>Sexo:</strong> <span id="sexo">-</span></p>
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

    <script>
        $(document).ready(function () {
            $('#formdpi').submit(function (e) {
                e.preventDefault();

                var dpi = $('#dpi').val().trim();

                if (dpi === '') {
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
                            $('#resultadocard').fadeIn();
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
                            $('#resultadocard').fadeOut();
                        }
                    },
                    error: function (err) {
                        console.error("Error en la petición:", err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de servidor',
                            text: 'Ocurrió un problema al procesar la consulta.'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>