<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    define('base_url', 'http://localhost/projects/farmacia-php/ecommerce/');
    define('base_url_blog', 'http://localhost/projects/farmacia-php/blog/');
    define('controller_default', 'PostsController');
    define('action_default', 'index');
    define('imagen_defecto','http://localhost/projects/farmacia-php/assets/img/imagen-defecto.png');
?>