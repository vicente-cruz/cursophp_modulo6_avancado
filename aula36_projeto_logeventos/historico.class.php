<?php

class historico {
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = new PDO("pgsql:dbname=projeto_logeventos;host=10.76.64.83","postgres","&kVyhG<({t}[");
    }
    
    public function registrar($acao)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $sql = "INSERT INTO historico(ip, data_acao, acao) VALUES (:ip, NOW(), :acao)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":ip",$ip);
        $query->bindValue(":acao",$acao);
        $query->execute();
    }
    
    public function mostrarRegistros()
    {
        $sql = "SELECT * FROM historico ";
        $query = $this->pdo->query($sql);
        
        if ($query->rowCount() > 0) {
            $registros = $query->fetchAll();
            
            foreach ($registros as $registro) {
                echo "Data: ".date('d/m/Y H:i:s', strtotime($registro['data_acao']))." - IP: ".$registro['ip']." - Ação: ".$registro['acao']."<br/>";
            }
        }
    }
}
