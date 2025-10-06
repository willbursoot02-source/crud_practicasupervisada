<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #141e30, #243b55);
            color: #fff;
            padding-top: 20px;
            transition: top 0.3s ease, left 0.3s ease;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin: 5px 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0f2027;
        }

        .content {
            padding: 20px;
        }

        .card {
            min-height: 350px;
        }

        .sidebar-toggle-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-toggle-btn {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1100;
                background: #141e30;
                color: #fff;
                border: none;
                padding: 8px 12px;
                border-radius: 5px;
                cursor: pointer;
            }

            .sidebar {
                position: fixed;
                top: -100%;
                left: 0;
                width: 100%;
                height: auto;
                z-index: 1050;
                padding-top: 60px;
                display: flex !important;
                flex-direction: column;
            }

            .sidebar.show {
                top: 0;
            }

            .content {
                padding-top: 60px;
            }

            .sidebar .btn {
                background: none;
                border: none;
                color: #fff;
                padding: 12px 20px;
                text-align: left;
                border-radius: 8px;
                margin: 5px 10px;
                transition: background 0.3s;
            }

            .sidebar .btn:hover {
                background-color: #0f2027;
            }

            .sidebar .collapse .dropdown-item {
                color: #fff;
                padding: 8px 25px;
                text-decoration: none;
                display: block;
            }

            .sidebar .collapse .dropdown-item:hover {
                background-color: #0f2027;
            }

        }
    </style>
</head>

<body>
    <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menú</button>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-lg-2 col-md-3 sidebar d-flex flex-column">
                <h3 class="text-center mb-4">Menú</h3>

                <a href="#" class="text-white px-3 py-2"
                    onclick="loadContent('{{ route('dashboard') }}', event)">Dashboard</a>

                <div class="accordion" id="sidebarAccordion">

                    <div class="accordion-item bg-transparent border-0">
                        <h2 class="accordion-header" id="headingPracticante">
                            <button class="accordion-button collapsed bg-transparent text-white px-3 py-2" type="button"
                                data-bs-toggle="collapse" data-bs-target="#practicanteMenu" aria-expanded="false"
                                aria-controls="practicanteMenu">
                                Practicante
                            </button>
                        </h2>
                        <div id="practicanteMenu" class="accordion-collapse collapse"
                            aria-labelledby="headingPracticante" data-bs-parent="#sidebarAccordion">
                            <div class="accordion-body p-0">
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('practicante.agregar') }}', event)">Agregar</a>
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('practicante.mostrar') }}', event)">Listado</a>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent border-0">
                        <h2 class="accordion-header" id="headingSupervisor">
                            <button class="accordion-button collapsed bg-transparent text-white px-3 py-2" type="button"
                                data-bs-toggle="collapse" data-bs-target="#supervisorMenu" aria-expanded="false"
                                aria-controls="supervisorMenu">
                                Supervisor
                            </button>
                        </h2>
                        <div id="supervisorMenu" class="accordion-collapse collapse" aria-labelledby="headingSupervisor"
                            data-bs-parent="#sidebarAccordion">
                            <div class="accordion-body p-0">
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('supervisor.agregrar') }}', event)">Agregar</a>
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('supervisor.mostrar') }}', event)">Listado</a>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent border-0">
                        <h2 class="accordion-header" id="headingControl">
                            <button class="accordion-button collapsed bg-transparent text-white px-3 py-2" type="button"
                                data-bs-toggle="collapse" data-bs-target="#controlMenu" aria-expanded="false"
                                aria-controls="controlMenu">
                                Control
                            </button>
                        </h2>
                        <div id="controlMenu" class="accordion-collapse collapse" aria-labelledby="headingControl"
                            data-bs-parent="#sidebarAccordion">
                            <div class="accordion-body p-0">
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('control.agregar') }}', event)">Agregar</a>
                                <a href="#" class="dropdown-item px-4 py-2"
                                    onclick="loadContent('{{ route('control.mostrar') }}', event)">Listado</a>
                            </div>
                        </div>
                    </div>

                </div>

                <a href="#" class="text-white px-3 py-2 mt-2"
                    onclick="loadContent('{{ route('busqueda.mostrar') }}', event)">Consultar</a>
            </nav>

            <div class="col-lg-10 col-md-9 mt- content" id="mainContent">
                <div class="container-fluid">
                    @include('graficas.dashboard')
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        function loadContent(url, event) {
            if (event) event.preventDefault();

            $.get(url, function (html) {
                $('#mainContent').html(html);
                if (event) {
                    $('.sidebar a').removeClass('active');
                    $(event.target).addClass('active');
                }
            }).fail(function (err) {
                console.error("Error al cargar contenido:", err);
            });
        }

        $(document).ready(function () {
            loadContent("{{ route('dashboard') }}");
            $('.sidebar a').removeClass('active');
            $('.sidebar a:first').addClass('active');
        });
        function toggleSidebar() {
            $('.sidebar').toggleClass('show');
        }
    </script>

</body>

</html>