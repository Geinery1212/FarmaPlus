<?php
if (!isset($_SESSION)) {
    session_start();
}

//No redirecciones go back para prevenir errores 
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

define('base_url', 'http://localhost/projects/backup_farmaplus/ecommerce/');
define('pagination_url', 'http://localhost/projects/backup_farmaplus/');
define('base_url_blog', 'http://localhost/projects/backup_farmaplus/blog/');
define('controller_default', 'ProductoController');
define('action_default', 'index');
define('imagen_defecto', 'http://localhost/projects/backup_farmaplus/assets/img/imagen-defecto.png');
