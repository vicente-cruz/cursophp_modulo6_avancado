<?php

class Documentos
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getDocumentos()
    {
        $documentos = array();
        
        $sql = "SELECT * FROM documentos";
        $query = $this->pdo->query($sql);
        
        if ($query->rowCount() > 0) {
            $documentos = $query->fetchAll();
        }
        
        return $documentos;
    }
}

?>