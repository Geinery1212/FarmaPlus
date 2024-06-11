<?php
require_once 'ecommerce/models/Usuario.php';
// Incluir la clase PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Requerir el archivo autoload.php de PHPMailer
require 'ecommerce/helpers/PHPMailer/Exception.php';
require 'ecommerce/helpers/PHPMailer/PHPMailer.php';
require 'ecommerce/helpers/PHPMailer/SMTP.php';
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
        header("Location:" . base_url . 'producto/index');
    }

    public function sendEmail()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = ConnectionDB::connect();

            // Validar y limpiar el correo electrónico
            $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $message = isset($_POST['message']) ? $_POST['message'] : false;

            $errores = array();

            // Validar el correo electrónico
            if (empty($email) || $email == false || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = '¡El correo electrónico no es válido!';
            }

            // Validar el nombre
            if (empty($name)) {
                $errores['name'] = '¡El nombre es obligatorio!';
            }

            // Validar el mensaje
            if (empty($message)) {
                $errores['message'] = '¡El mensaje es obligatorio!';
            }

            if (count($errores) == 0) {
                // Crear una instancia de PHPMailer
                $mail = new PHPMailer(true); // Pasar true habilita las excepciones					
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'farmaplus656@gmail.com';                     //SMTP username
                    $mail->Password   = 'rfkogdinunvruwqm';                               //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    // Configurar el remitente y el destinatario
                    $mail->setFrom($email, $name);
                    $mail->addAddress('farmaplus656@gmail.com', 'FarmaPlus');
                    $mail->addReplyTo($email, $name);

                    // Contenido del correo electrónico
                    $mail->isHTML(true); // Habilitar el formato HTML
                    $mail->Subject = 'Mensaje de contacto desde el sitio web';
                    $mail->Body = $message;
                    $mail->AltBody = strip_tags($message);                    // Cuerpo alternativo en texto plano

                    // Configuración del conjunto de caracteres a UTF-8
                    $mail->CharSet = 'UTF-8';

                    // Enviar el correo electrónico
                    $mail->send();
                    $_SESSION['UserControllerMessageSuccess'] = 'Tu mensaje ha sido enviado con éxito. Responderemos a tu correo electrónico tan pronto como sea posible.';
                    header("Location:" . base_url . 'producto/index');
                } catch (Exception $e) {
                    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                }
            } else {
                // Si hay errores, guardarlos en la sesión para mostrarlos al usuario
                $_SESSION['errores'] = $errores;
                header("Location:" . base_url . 'shopInfo/contacto');
            }
        }
    }
}
