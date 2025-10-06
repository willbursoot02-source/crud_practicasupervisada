<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--FONT AWESOME 5-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />



</head>

<body>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #2596be;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #f8f9fa;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .nav-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
        }

        .icono-central {
            width: 47px;
            height: 40px;
            margin-right: 10px;
            color: #009fd7;
            font-size: 44px;
        }

        .icono-grande {
            font-size: 64px;
            justify-items: center;
        }

        .card-yaz {
            background: linear-gradient(to right, #00b1ef, #4dc8f4);
            color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px auto;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

            <a href="#" class="nav-item">
                <span class="material-symbols-outlined icono-central">
                    corporate_fare
                </span>
                <h3>Registro Institucional de Prácticas Supervisadas</h3>
            </a>
        </div>
    </nav>
    <div class="container mt-3 py-2">
        <div class="row ">
            <div class="col-sm-4">
                <div class="card card-yaz" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined icono-grande">
                            how_to_reg
                        </span>
                        <div class="text-white">
                            <h3>Practicantes</h3>
                        </div>
                        <a href="{{ route('practicante.agregar') }}" class="text-white">Agregar</a>
                        <a href="{{ route('practicante.mostrar') }}" class="text-white">Listado</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-yaz" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined icono-grande">
                            supervisor_account
                        </span>

                        <div class="text-white">
                            <h3>Supervisores</h3>
                        </div>

                        <a href="{{ route('supervisor.agregrar') }}" class="text-white">Agregar</a>
                        <a href="{{ route('supervisor.mostrar') }}" class="text-white">Listado</a>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-yaz" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined icono-grande">
                            user_attributes
                        </span>

                        <div class="text-white">
                            <h4>Asignación de Supervisión</h4>
                        </div>

                        <a href="{{ route('control.agregar') }}" class="text-white">Agregar</a>
                        <a href="{{ route('control.mostrar') }}" class="text-white">Listado</a>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-yaz" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined icono-grande">
                            data_loss_prevention
                        </span>

                        <div class="text-white">
                            <h4>Consulta de DPI</h4>
                        </div>

                        <a href="{{ route('busqueda.mostrar') }}" class="text-white">consultar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card card-yaz" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined icono-grande">
                            monitoring
                        </span>

                        <div class="text-white">
                            <h4>Panel de datos</h4>
                        </div>

                        <a href="{{ route('graficas.index') }}" class="text-white">Ver</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!--bootstrap ja-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>