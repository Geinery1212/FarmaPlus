<?php 
class BuscadorController{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionDB::connect();
    }

    public function buscar(){
        $entradas = conseguirEntradas($this->db, null, null, $_POST['buscar']);        
        require_once 'blog/views/buscador/resultados.php';
    }
}
?>