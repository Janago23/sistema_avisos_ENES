<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro de usuario</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <div class="border rounded shadow p-4">
                    <h2 class="text-center mb-4">Registro de usuario</h2>
                    <?php if(isset($validation)):?>
                    <div class="alert alert-warning">
                       <?= $validation->listErrors() ?>
                    </div>
                    <?php endif;?>
                    <form action="<?= site_url('SignupController/store') ?>" method="post">
                        <div class="form-group mb-3">
                            <input type="text" name="nombre_usuario" placeholder="Nombre" value="<?= set_value('nombre_usuario') ?>" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="correo" placeholder="Correo" value="<?= set_value('correo') ?>" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="pswd" placeholder="Contraseña" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="confirmpassword" placeholder="Confirma tu contraseña" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="rol">Rol</label>
                            <select name="rol" class="form-control" required>
                                <option value="admin" <?= set_select('rol', 'admin') ?>>Admin</option>
                                <option value="superadmin" <?= set_select('rol', 'superadmin') ?>>Super Admin</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

