<?php
if (!isset($_SESSION)) {
    session_start();
}

//No redirecciones go back para prevenir errores 
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

define('base_url', 'http://localhost/projects/farmacia-php/ecommerce/');
define('pagination_url', 'http://localhost/projects/farmacia-php/');
define('base_url_blog', 'http://localhost/projects/farmacia-php/blog/');
define('controller_default', 'ProductoController');
define('action_default', 'index');
define('imagen_defecto', 'http://localhost/projects/farmacia-php/assets/img/imagen-defecto.png');
