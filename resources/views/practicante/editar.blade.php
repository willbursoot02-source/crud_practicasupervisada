<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Practicante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Practicante</h2>

        <form action="{{ route('practicante.actualizar', $practicante->id_practicante) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $practicante->nombre }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" value="{{ $practicante->edad }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ $practicante->telefono }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Institución</label>
                <input type="text" name="institucion" class="form-control" value="{{ $practicante->institucion }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Carrera</label>
                <input type="text" name="carrera" class="form-control" value="{{ $practicante->carrera }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Área</label>
                <input type="text" name="area" class="form-control" value="{{ $practicante->area }}">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
</body>

</html>