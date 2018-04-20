<?php
class Reservas
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getReservas($data_inicio, $data_fim)
    {
        $reservas = array();
        
        $sql = "SELECT * FROM reservas "
                . "WHERE"
                . " NOT ("
                . "  data_inicio > :data_fim"
                . "  OR"
                . "  data_fim < :data_inicio"
                . ") ";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":data_inicio", $data_inicio);
        $query->bindValue(":data_fim", $data_fim);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $reservas = $query->fetchAll();
        }
        
        return $reservas;
    }
    
    public function verificarDisponibilidade($carro, $data_inicio, $data_fim)
    {
        $sql = "SELECT"
                . " * "
                . "FROM"
                . " reservas "
                . "WHERE"
                . " id_carro = :id_carro "
                . "AND"
                . " NOT ("
                . "  data_inicio > :data_fim"
                . "  OR"
                . "  data_fim < :data_inicio"
                . ") ";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id_carro",$carro);
        $query->bindValue(":data_inicio",$data_inicio);
        $query->bindValue(":data_fim", $data_fim);
        $query->execute();
        
        // Já existe reserva
        if ($query->rowCount() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function reservar($carro, $data_inicio, $data_fim, $pessoa)
    {
        $sql = "INSERT INTO reservas (id_carro, data_inicio, data_fim, pessoa) VALUES (:id_carro,:data_inicio,:data_fim,:pessoa)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id_carro",$carro);
        $query->bindValue(":data_inicio",$data_inicio);
        $query->bindValue(":data_fim",$data_fim);
        $query->bindValue(":pessoa",$pessoa);
        $query->execute();
    }
}
?>