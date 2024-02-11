<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menú Lateral con Pestañas Desplegables en Bootstrap 5</title>
    <!-- Enlaces a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Agrega tu propio estilo CSS si es necesario -->
    <style>
        body {
            padding-top: 56px; /* Ajusta el cuerpo para dejar espacio para la barra de navegación */
        }

        /* Estilo adicional para el contenido */
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Inicio <span class="sr-only">(actual)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Página 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Página 2</a>
            </li>
            <!-- Agrega más elementos de menú según sea necesario -->
        </ul>
    </div>
</nav>

<!-- Menú lateral con pestañas desplegables -->
<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="collapse" href="#submenu1" role="button" aria-expanded="false">
                            Pestaña 1
                        </a>
                        <div class="collapse" id="submenu1">
                            <ul class="list-unstyled">
                                <li><a href="#">Subpestaña 1.1</a></li>
                                <li><a href="#">Subpestaña 1.2</a></li>
                                <!-- Agrega más subpestañas según sea necesario -->
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#submenu2" role="button" aria-expanded="false">
                            Pestaña 2
                        </a>
                        <div class="collapse" id="submenu2">
                            <ul class="list-unstyled">
                                <li><a href="#">Subpestaña 2.1</a></li>
                                <li><a href="#">Subpestaña 2.2</a></li>
                                <!-- Agrega más subpestañas según sea necesario -->
                            </ul>
                        </div>
                    </li>
                    <!-- Agrega más pestañas según sea necesario -->
                </ul>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Contenido Principal</h1>
            </div>

            <!-- Aquí va tu contenido -->

        </main>
    </div>
</div>

</body>
</html>
