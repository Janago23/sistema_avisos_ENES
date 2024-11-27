<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inicio de sesión</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <!-- Contenedor con bordes redondeados y sombra -->
                <div class="border p-4 rounded shadow">
                    <h2 class="text-center mb-4">Inicia sesión</h2>
                    
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-warning">
                           <?= session()->getFlashdata('msg') ?>
                        </div>
                    <?php endif;?>

                    <form action="<?= base_url('SigninController/loginAuth') ?>" method="post">
                        <div class="form-group mb-3">
                            <input type="email" name="correo" placeholder="Correo" value="<?= set_value('correo') ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="pswd" placeholder="Contraseña" class="form-control" required>
                        </div>

                        <div class="d-grid">
                             <button type="submit" class="btn btn-success">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
