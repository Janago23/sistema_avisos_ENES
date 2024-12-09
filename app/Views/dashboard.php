<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/publicaciones') ?>">Gestionar Publicaciones</a>
                    </li>
                    <?php if ($rol === 'superadmin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/usuarios') ?>">Gestionar Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/configuracion') ?>">Configuraciones</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Sección principal -->
            <div class="col-md-9 col-lg-10 p-5">
                <h1 class="mb-4">Bienvenido al Dashboard</h1>
                <h3>Hola, <?= esc($nombre_usuario) ?> 👋</h3>
                <p>Tu rol es: <?= esc($rol) ?></p>

               

               <!-- Tabla con paginación -->
               <div class="mt-4">
    <h5> Publicaciones</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <?php if ($rol === 'superadmin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($publicaciones)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No hay publicaciones disponibles.
                        <?php if ($rol === 'superadmin'): ?>
                            <a href="<?= base_url('/publicaciones/agregar') ?>" class="btn btn-primary btn-sm mt-2">Añadir Publicación</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($publicaciones as $publicacion): ?>
                    <tr>
                        <td><?= esc($publicacion['id']) ?></td>
                        <td><?= esc($publicacion['titulo']) ?></td>
                        <td><?= esc($publicacion['estado']) ?></td>
                        <td><?= date('d-m-Y', strtotime($publicacion['fecha_creacion'])) ?></td>
                        <?php if ($rol === 'superadmin'): ?>
                            <td>
                                <a href="<?= base_url('/habilitar/' . $publicacion['id']) ?>" class="btn btn-success btn-sm">Habilitar</a>
                                <a href="<?= base_url('/deshabilitar/' . $publicacion['id']) ?>" class="btn btn-secondary btn-sm">Deshabilitar</a>
                                <a href="<?= base_url('/eliminar/' . $publicacion['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if (isset($pager) && $pager->hasPages()): ?>
    <?= $pager->links() ?>
    <?php endif; ?>

</div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
