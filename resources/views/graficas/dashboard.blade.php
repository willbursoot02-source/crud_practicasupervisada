<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Practicantes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            min-height: 400px; 
        }

        .card-body {
            display: flex;
            flex-direction: column;
            min-height: 400px; 
        }

        .chart-container {
            flex-grow: 1;
            min-height: 300px;
            height: 100%;
        }

        .card-title {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row g-4">
            <div class="col-12 col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column">
                        <label for="sexo" class="form-label">Filtrar por sexo</label>
                        <select id="sexo" class="form-select mb-3">
                            <option value="">Mostrar todos</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <h5 class="card-title mb-3">Clasificación de Supervisores</h5>
                        <div class="chart-container">
                            @include('graficas.supervisores_generos')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column">
                        <label for="institucionSelect" class="form-label">Filtrar por institución</label>
                        <select id="institucionSelect" class="form-select mb-3">
                            <option value="">Todas las instituciones</option>
                            @foreach ($practicantes->pluck('institucion')->unique() as $institucion)
                                <option value="{{ $institucion }}">{{ $institucion }}</option>
                            @endforeach
                        </select>
                        <h5 class="card-title mb-3">Practicantes por Entidades</h5>
                        <div class="chart-container">
                            @include('graficas.practicantes_institucion')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column">
                        <label for="edadSelect" class="form-label">Filtrar por edad</label>
                        <select id="edadSelect" class="form-select mb-3">
                            <option value="">Mostrar todos</option>
                            @foreach ($practicantes->pluck('edad')->unique() as $edad)
                                <option value="{{ $edad }}">{{ $edad }}</option>
                            @endforeach
                        </select>
                        <h5 class="card-title mb-3">Rango de Edades de Practicantes</h5>
                        <div class="chart-container">
                            @include('graficas.practicantes_edad')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column">
                        <label for="tipoSelect" class="form-label">Filtrar por tipo</label>
                        <select id="tipoSelect" class="form-select mb-3">
                            <option value="">Mostrar todos</option>
                            <option value="Supervisores">Supervisores</option>
                            <option value="Practicantes">Practicantes</option>
                        </select>
                        <h5 class="card-title mb-3">Comparativa por Categoría</h5>
                        <div class="chart-container">
                            @include('graficas.comparativa')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
