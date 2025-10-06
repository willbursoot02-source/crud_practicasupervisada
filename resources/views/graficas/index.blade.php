<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <div class="container min-vh-100">

    <div class="row justify-content-center align-items-center">
      <div class="mb-5 mt-5">
        <h1>Análisis de Supervisores y Practicantes</h1>
      </div>
    </div>

    <div class="row justify-content-center align-items-center">
      <!-- Primer grafica-->
      <div class="col-md-6 col-lg-6 mb-4">
        <div class="card me-2">
          <div class="card-body">
            <select id="sexo" class="form-control">
              <option value="">Mostrar todos</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
            <h5 class="mb-3">Clasificación</h5>
            @include('graficas.supervisores_generos')
          </div>
        </div>
      </div>
      <!-- fin-->

      <!-- Segunda grafica-->
      <div class="col-md-6 col-lg-6 mb-4 ">
        <div class="card me-2">
          <div class="card-body">
            <select id="institucionSelect" class="form-control">
              <option value="">Todas las instituciones</option>
              @foreach ($practicantes->pluck('institucion')->unique() as $institucion)
                <option value="{{ $institucion }}">{{ $institucion }}</option>
              @endforeach
            </select>
            <h5 class="mb-3">Practicantes por Entidades</h5>
            @include('graficas.practicantes_institucion')
          </div>
        </div>
      </div>
      <!-- fin-->
    </div>

    <div class="row justify-content-center align-items-center">
      <!-- tercera grafica-->
      <div class="col-md-6 col-lg-6 mb-4">
        <div class="card me-2">
          <div class="card-body">
            <select id="edadSelect" class="form-control">
              <option value="">Mostrar todos</option>
              @foreach ($practicantes->pluck('edad')->unique() as $edad)
                <option value="{{ $edad }}">{{ $edad }}</option>
              @endforeach
            </select>
            <h5 class="mb-3">Rango de Edades</h5>
            @include('graficas.practicantes_edad')
          </div>
        </div>
      </div>
      <!-- fin-->

      <!-- cuarta grafica-->
      <div class="col-md-6 col-lg-6 mb-4 ">
        <div class="card me-2">
          <div class="card-body">
            <select id="tipoSelect" class="form-control">
              <option value="">Mostrar todos</option>
              <option value="Supervisores">Supervisores</option>
              <option value="Practicantes">Practicantes</option>
            </select>
            <h5 class="mb-3">Personal por Categoría</h5>
            @include('graficas.comparativa')
          </div>
        </div>
      </div>
      <!-- fin-->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>