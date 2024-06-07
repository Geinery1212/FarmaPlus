<?php

class PostsController
{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionDB::connect();
    }
    public function index()
    {
        $entradas = conseguirEntradas($this->db, true);
        require_once 'blog/views/posts/postsPrincipales.php';
    }
    public function todasEntradas()
    {
        $entradas = conseguirEntradas($this->db);
        require_once 'blog/views/posts/allPosts.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $entrada_actual = conseguirEntrada($this->db, $_GET['id']);
            if (!isset($entrada_actual['id'])) {
                header("Location: index");
            }
            require_once 'blog/views/posts/singlePost.php';
        } else {
            header("Location: index");
        }
    }

    public function mostrarPaginaCrear()
    {
        $categorias = conseguirCategorias($this->db);
        require_once 'blog/views/posts/crearPost.php';
    }

    public function mostrarPaginaEditar()
    {
        $entrada_actual = conseguirEntrada($this->db, $_GET['id']);
        $categorias = conseguirCategorias($this->db);

        if (!isset($entrada_actual['id']) || empty($categorias)) {
            header("Location: index");
        }
        require_once 'blog/views/posts/editarPost.php';
    }

    public function guardarPost()
    {
        if (isset($_POST)) {
            $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($this->db, $_POST['titulo']) : false;
            $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($this->db, $_POST['descripcion']) : false;
            $resumen = isset($_POST['resumen']) ? mysqli_real_escape_string($this->db, $_POST['resumen']) : false;
            $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
            $usuario = $_SESSION['identity']->id;

            // Validación
            $errores = array();

            if (empty($titulo)) {
                $errores['titulo'] = 'El titulo no es válido';
            }

            if (empty($descripcion)) {
                $errores['cuerpo'] = 'El cuerpo no es válido';
            }

            if (empty($resumen)) {
                $errores['resumen'] = 'El resumen no es válido';
            }

            if (empty($categoria) && !is_numeric($categoria)) {
                $errores['categoria'] = 'La categoría no es válida';
            }


            if (count($errores) == 0) {
                if (isset($_GET['editar'])) {
                    $entrada_id = $_GET['editar'];
                    $usuario_id = $_SESSION['identity']->id;

                    $sql = "UPDATE entradas_blog SET titulo='$titulo', descripcion='$descripcion',resumen='$resumen', categoria_id=$categoria " .
                        " WHERE id = $entrada_id AND usuario_id = $usuario_id";
                } else {
                    $sql = "INSERT INTO entradas_blog (usuario_id, categoria_id, titulo, descripcion, resumen, fecha) 
        VALUES ($usuario, $categoria, '$titulo', '$descripcion', '$resumen', CURDATE());";
                }
                $guardar = mysqli_query($this->db, $sql);
                if ($guardar == true) {
                    $_SESSION['PostsControllerMessageSuccess'] =  isset($_GET['editar']) ? "La entrada se edito de manera correcta." : "La entrada se agregó de manera correcta.";
                } else {
                    $_SESSION['PostsControllerMessageError'] = isset($_GET['editar']) ? "Ocurrió un error al editar la entrada" : "Ocurrió un error al agregar la entrada";
                }
                header("Location: index");
            } else {

                $_SESSION["errores_entrada"] = $errores;

                if (isset($_GET['editar'])) {
                    header("Location: editar-entrada.php?id=" . $_GET['editar']);
                } else {
                    header("Location: mostrarPaginaCrear");
                }
            }
        }
    }

    public function borrarPost()
    {
        if (isset($_SESSION['identity']) && isset($_GET['id'])) {
            $entrada_id = $_GET['id'];
            $usuario_id = $_SESSION['identity']->id;

            $sql = "DELETE FROM entradas_blog WHERE usuario_id = $usuario_id AND id = $entrada_id";
            $borrar = mysqli_query($this->db, $sql);
            if ($borrar == true) {
                $_SESSION['PostsControllerMessageSuccess'] =  "La entrada se eliminó de manera correcta.";
            } else {
                $_SESSION['PostsControllerMessageError'] = "Ocurrió un error al eliminar la entrada";
            }
        }

        header("Location: todasEntradas");
    }
}
