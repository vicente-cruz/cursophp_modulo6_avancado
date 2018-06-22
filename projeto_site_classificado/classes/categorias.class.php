<?php

class Categorias {
    
    public function getCategorias()
    {
        $categorias = array();
        global $pdo;
        
        $query = $pdo->query("SELECT * FROM categorias");
        if ($query->rowCount() > 0) {
            $categorias = $query->fetchAll();
        }
        
        return $categorias;
    }
}
