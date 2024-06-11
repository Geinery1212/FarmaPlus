<?php
class CategoriaBlogController{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionDB::connect();
    }

    
    public function mostrarPaginaCategoria(){
        require_once 'blog/views/categoria/crearCategoria.php';        
    }

    public function postsCategoria(){
        $categoria_actual = conseguirCategoria($this->db, $_GET['id']);
        $entradas = conseguirEntradas($this->db, null, $_GET['id'], null);
        require_once 'blog/views/posts/postsCategoria.php';        
    }


    public function guardarCategoria(){   
        if(isset($_POST)){                     
            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($this->db, $_POST['nombre']) : false;            
            // Array de errores
            $errores = array();
            
            // Validar los datos antes de guardarlos en la base de datos
            // Validar campo nombre
            if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
                $nombre_validado = true;
            }else{
                $nombre_validado = false;
                $_SESSION['CategoriaControllerMessageError'] = 'El nombre no es válido.';
                }
                
                if(count($errores) == 0){
                    $sql = "INSERT INTO categorias_blog VALUES(NULL, '$nombre');";
                    $guardar = mysqli_query($this->db, $sql);
                    $_SESSION['CategoriaControllerMessageSuccess'] = 'La categoría se agregó de manera correcta .';
            }
            header("Location: mostrarPaginaCategoria");
        }
    }
}
?>