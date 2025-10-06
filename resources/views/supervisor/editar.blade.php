<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Practicante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar supervisor</h2>

        <form action="{{ route('supervisor.actualizar', $supervisor->id_supervisor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $supervisor->nombre }}">
            </div>

            <div class="mb-3">
                <label class="form-label">DPI</label>
                <input type="number" name="cui" class="form-control" value="{{ $supervisor->cui }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ $supervisor->telefono }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="text" name="correo" class="form-control" value="{{ $supervisor->correo }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Cargo</label>
                <input type="text" name="cargo" class="form-control" value="{{ $supervisor->cargo }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sexo</label>
                <input type="text" name="sexo" class="form-control" value="{{ $supervisor->sexo }}">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
</body>

</html>