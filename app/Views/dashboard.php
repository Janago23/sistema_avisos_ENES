<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema de Avisos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/logout') ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <!-- Menú lateral -->
            <div class="col-md-3 col-lg-2 bg-light vh-100 p-3">
                <h5 class="text-center">Menú</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/dashboard') ?>">Inicio</a>
                    </li>
                    <?php if ($rol === 'superadmin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/signup') ?>">Registrar nuevo usuario</a>
                    </li>
                    <?php endif; ?>
                    <!-- Agrega más opciones según necesidades -->
                </ul>
            </div>

            <!-- Sección principal -->
            <div class="col-md-9 col-lg-10 p-5">
                <h1 class="mb-4">Bienvenido al Dashboard</h1>
                <h3>Hola, <?= esc($nombre_usuario) ?> 👋</h3>
                <p>Tu rol es: <?= esc($rol) ?></p>

                <!-- Contenido principal -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Resumen</h5>
                        <p class="card-text">Aquí puedes gestionar los anuncios del sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
