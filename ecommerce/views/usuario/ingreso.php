<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../config/parameters.php';
require_once '../../helpers/Utils.php';
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url ?>assets/login/css/styles.css" />
    <!-- Agrega jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Agrega Easy Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Configuraciones globales de Toastr
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <title>Farmacia Jesusito</title>
</head>

<body>
    <?php if (isset($_SESSION['error_login'])) : ?>
        <script>
            toastr.error('Error en la identificación.');
        </script>
    <?php endif; ?>

    <?php if (isset($_SESSION['errores'])) : ?>
        <?php foreach ($_SESSION['errores'] as $indice => $elemento) : ?>
            <script>
                toastr.error("<?= $elemento; ?>");
            </script>
        <?php endforeach; ?>

    <?php endif; ?>
    <?php Utils::deleteSession('errores') ?>
    <?php Utils::deleteSession('error_login') ?>
    <div class="login-container">
        <div class="login-info-container">
            <h1 class="login-title">Ingresa con</h1>

            <div class="social-login">
                <div class="social-login-element">
                    <img src="<?= base_url ?>assets/img/logo-farmacia.png" alt="google-image" />
                </div>
            </div>
            <form action="<?= base_url ?>Usuario/loguear" method="POST" class="inputs-container">
                <input class="input" name="email" placeholder="Email" />
                <input class="input" name="password" type="password" placeholder="Contraseña" />
                <p>
                    ¿Olvidaste tu contraseña?
                    <a class="login-a" href="#">
                        <span class="span">Click aquí</span>
                    </a>
                </p>
                <input class="btn" type="submit" value="Loguear">
                <p>¿No tienes una cuenta? <span class="span"><a href="<?= base_url ?>views/usuario/registro.php">Registrate</a></span></p>
            </form>
        </div>
        <img class="image-container" src="<?= base_url ?>assets/login/images/login.svg" alt="login" />
    </div>
</body>

</html>