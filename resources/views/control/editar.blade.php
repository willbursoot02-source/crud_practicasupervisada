<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Control</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Control</h2>

        <form action="{{ route('control.actualizar', $control->id_control) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Supervisor</label>
                <select name="id_supervisor" class="form-control">
                    @foreach($supervisores as $sup)
                        <option value="{{ $sup->id_supervisor }}" {{ $control->id_supervisor == $sup->id_supervisor ? 'selected' : '' }}>
                            {{ $sup->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Practicante</label>
                <select name="id_practicante" class="form-control">
                    @foreach($practicantes as $prac)
                        <option value="{{ $prac->id_practicante }}" {{ $control->id_practicante == $prac->id_practicante ? 'selected' : '' }}>
                            {{ $prac->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" name="fecha_control" class="form-control" value="{{ $control->fecha_control }}">
            </div>

            <div class="mb-3">
                <label>Comentario</label>
                <textarea name="comentario" class="form-control">{{ $control->comentario }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('control.mostrar') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>