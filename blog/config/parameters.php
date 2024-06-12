<?php
if (!isset($_SESSION)) {
    session_start();
}
define('base_url', 'http://localhost/projects/backup_farmaplus/ecommerce/');
define('base_url_blog', 'http://localhost/projects/backup_farmaplus/blog/');
define('controller_default', 'PostsController');
define('action_default', 'index');
define('imagen_defecto', 'http://localhost/projects/backup_farmaplus/assets/img/imagen-defecto.png');
