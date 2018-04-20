<?php
class Carros
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getCarros()
    {
        $carros = array();
        
        $sql = "SELECT * FROM carros";
        $query = $this->pdo->query($sql);
        if ($query->rowCount() > 0) {
            $carros = $query->fetchAll();
        }
        
        return $carros;
    }
}