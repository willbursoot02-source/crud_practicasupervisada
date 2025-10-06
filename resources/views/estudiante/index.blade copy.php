<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #eff3f2;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #1c1c1c;
            color: #fff;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .profile {
            text-align: center;
            border-top: 1px solid #444;
            padding-top: 15px;
        }

        .profile img {
            width: 40px;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }

        .chart-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .chart-container canvas,
        .chart-container svg {
            max-width: 100% !important;
            height: auto !important;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div>
            <div class="d-flex justify-content-center">
                <i class="bi bi-house-door-fill fs-3"></i>
            </div>

            <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-house me-2"></i> Inicio</a>
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center text-white" href="#" role="button"
                    id="ordersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-files me-2"></i> Supervisores
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="ordersDropdown">
                    <li><a class="dropdown-item" href="{{ route('supervisor.mostrar') }}">Listado</a></li>
                    <li><a class="dropdown-item" href="{{ route('supervisor.agregrar') }}">Agregar</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center text-white" href="#" role="button"
                    id="ordersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-collection-fill me-2"></i> Practicantes
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="ordersDropdown">
                    <li><a class="dropdown-item" href="{{ route('practicante.mostrar') }}">Listado</a></li>
                    <li><a class="dropdown-item" href="{{ route('practicante.agregar') }}">Agregar</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center text-white" href="#" role="button"
                    id="ordersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-archive me-2"></i> Control
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="ordersDropdown">
                    <li><a class="dropdown-item" href="{{ route('control.mostrar') }}">Listado</a></li>
                    <li><a class="dropdown-item" href="{{ route('control.agregar') }}">Agregar</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content p-5">
        <div class="container-fluid">

            <div class="row justify-content-center align-items-start g-4">
                <div class="col-12 col-md-6">
                    <div class="card h-100" style="min-height: 350px;">
                        <div class="card-body">
                            <select id="sexo" class="form-select">
                                <option value="">Mostrar todos</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            <h5 class="mb-3 mt-3">Clasificación</h5>
                            <div class="chart-container">
                                @include('graficas.supervisores_generos')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100" style="min-height: 350px;">
                        <div class="card-body">
                            <select id="institucionSelect" class="form-select">
                                <option value="">Todas las instituciones</option>
                                @foreach ($practicantes->pluck('institucion')->unique() as $institucion)
                                    <option value="{{ $institucion }}">{{ $institucion }}</option>
                                @endforeach
                            </select>
                            <h5 class="mb-3 mt-3">Practicantes por Entidades</h5>
                            <div class="chart-container">
                                @include('graficas.practicantes_institucion')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-start g-4 mt-3">
                <div class="col-12 col-md-6">
                    <div class="card h-100" style="min-height: 350px;">
                        <div class="card-body">
                            <select id="edadSelect" class="form-select">
                                <option value="">Mostrar todos</option>
                                @foreach ($practicantes->pluck('edad')->unique() as $edad)
                                    <option value="{{ $edad }}">{{ $edad }}</option>
                                @endforeach
                            </select>
                            <h5 class="mb-3 mt-3">Rango de Edades</h5>
                            <div class="chart-container">
                                @include('graficas.practicantes_edad')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100" style="min-height: 350px;">
                        <div class="card-body">
                            <select id="tipoSelect" class="form-select">
                                <option value="">Mostrar todos</option>
                                <option value="Supervisores">Supervisores</option>
                                <option value="Practicantes">Practicantes</option>
                            </select>
                            <h5 class="mb-3 mt-3">Personal por Categoría</h5>
                            <div class="chart-container">
                                @include('graficas.comparativa')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>