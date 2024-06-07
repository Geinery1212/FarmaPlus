<?php
    function autoload($classname){
        $directories = array(
            'ecommerce/controllers/',
            'blog/controllers/' // Agrega aquí el nombre del nuevo directorio
        );
        
        foreach ($directories as $directory) {
            $file = $directory . $classname . '.php';
            if (file_exists($file)) {
                include $file;
                return;
            }
        }
    }
    
    spl_autoload_register('autoload');
    
    // spl_autoload_register('autoload');
?>