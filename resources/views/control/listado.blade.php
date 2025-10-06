<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Control</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
    </style>
</head>

<body>

    <div class="container container-custom mb-4">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-custom-secondary"
                onclick="loadContent('{{ route('dashboard') }}', event)">Inicio</a>
        </div>

        <h2 class="text-center mb-4">Asignación de Supervisión</h2>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supervisor</th>
                        <th>Practicante</th>
                        <th>Fecha</th>
                        <th>Comentario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($control as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nombre_supervisor }}</td>
                            <td>{{ $item->nombre_practicante }}</td>
                            <td>{{ $item->fecha_control }}</td>
                            <td>{{ $item->comentario }}</td>
                            <td>{{ $item->estado_texto }}</td>
                            <td>

                                <a href="{{ route('control.editar', $item->id_control) }}"
                                    class="btn btn-custom-primary btn-sm">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>