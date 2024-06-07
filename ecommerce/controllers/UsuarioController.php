<?php
require_once 'ecommerce/models/Usuario.php';
class UsuarioController
{

    public function registrar()
    {
        if (isset($_POST)) {
            $db = ConnectionDB::connect();
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
            $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
            $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
            $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

            $errores = array();

            if (empty($nombre) || $nombre == false || is_numeric($nombre) || preg_match('/[0-9]/', $nombre)) {
                $errores['nombre'] = '¡El nombre no es valido!';
            }
            if (empty($apellidos) || $apellidos == false || is_numeric($apellidos) || preg_match('/[0-9]/', $apellidos)) {
                $errores['apellidos'] = '¡Apellidos no validos!';
            }
            if (empty($email) || $email == false || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = '¡El email no es valido!';
            }
            if (empty($password) || $password == false) {
                $errores['password'] = '¡La contraseña no es valida!';
            }

            if (count($errores) == 0) {
                $usario = new Usuario();
                $usario->setNombre($nombre);
                $usario->setApellidos($apellidos);
                $usario->setEmail($email);
                $usario->setPassword($password);
                if ($usario->emailExists($email)) {
                    $_SESSION['register'] = 'duplicated_email';
                } else {
                    $registrar = $usario->registrar();
                    if ($registrar) {
                        $_SESSION['register'] = 'complete';
                    } else {
                        $_SESSION['register'] = 'failed';
                    }
                }
            } else {
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['register'] = 'failed';
        }
        if ($_SESSION['register'] == 'failed' || $_SESSION['register'] == 'duplicated_email' || count($errores) != 0) {
            header("Location:" . base_url . 'views/usuario/registro.php');            
        } else {
            header("Location:" . base_url . 'producto/index');
        }
    }

    public function loguear()
    {
        if (isset($_POST)) {
            $db = ConnectionDB::connect();
            $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
            $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

            $errores = array();

            if (empty($email) || $email == false || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = '¡El email no es valido!';
            }
            if (empty($password) || $password == false) {
                $errores['password'] = '¡La contraseña no es valida!';
            }
            if (count($errores) == 0) {
                $user = new Usuario();
                $user->setEmail($email);
                $user->setPassword($password);
                $identity = $user->loguear();
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    if ($identity->rol == 'admin') {
                        $_SESSION['admin'] = true;
                    }
                } else {
                    $_SESSION['error_login'] = '¡Identificacion Fallida!';
                }
            } else {
                $_SESSION['errores'] = $errores;
            }
        }
        if (!isset($_POST) || isset($_SESSION['error_login']) || count($errores) != 0) {
            header("Location:" . base_url . 'views/usuario/ingreso.php');
        } else {
            $_SESSION['successful_login'] = '¡Bienvenido a FamaPlus!';
            header("Location:" . base_url . 'producto/index');
        }
    }
    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url . 'Producto/index');
    }
}
