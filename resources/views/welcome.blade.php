<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <div class="container">
        <div class="row">
            <!-- Supervisores -->
            <div class="col-md-6">
                <h4>Supervisores</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supervisores as $supervisor)
                            <tr>
                                <td>{{ $supervisor->nombre }}</td>
                                <td>{{ $supervisor->cargo }}</td>
                                <td>
                                    <form action="{{ route('usuarios.info') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tipo" value="supervisor">
                                        <input type="hidden" name="id_relacion" value="{{ $supervisor->id_supervisor }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Añadir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Practicantes -->
            <div class="col-md-6">
                <h4>Practicantes</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Área</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practicantes as $practicante)
                            <tr>
                                <td>{{ $practicante->nombre }}</td>
                                <td>{{ $practicante->area }}</td>
                                <td>
                                    <form action="{{ route('usuarios.info') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tipo" value="practicante">
                                        <input type="hidden" name="id_relacion" value="{{ $practicante->id_practicante }}">
                                        <button type="submit" class="btn btn-sm btn-primary">Añadir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Usuarios asignados -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Usuarios asignados</h4>
                <ul class="list-group">
                    @foreach($usuarios as $usuario)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @if($usuario->tipo == 'supervisor')
                                {{ $usuario->supervisor->nombre }} (Supervisor)
                            @else
                                {{ $usuario->practicante->nombre }} (Practicante)
                            @endif

                            <form action="{{ route('usuarios.destruir', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Quitar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</body>

</html>