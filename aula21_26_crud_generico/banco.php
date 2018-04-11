<?php
// Aula 21
class Banco
{
    private $pdo;
    private $numRows;
    private $queryResult;
    
    public function __construct($host, $dbname, $dbuser, $dbpass) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$dbuser, $dbpass);
        } catch(PDOException $e) {
            echo "Erro: ".$e->getMessage();
        }
    }
    
    // Aula 22
    public function query($sql)
    {
        $query = $this->pdo->query($sql);
        $this->numRows = $query->rowCount();
        $this->queryResult = $query->fetchAll();
    }
    
    // Aula 23
    public function result()
    {
        return $this->queryResult;
    }
    
    public function numRows()
    {
        return $this->numRows;
    }
    
    // Aula 24
    public function insert($table, $data)
    {
        if (!empty($table) && (is_array($data) && count($data) > 0)) {
            $sql = "INSERT INTO ".$table." SET ";
            
            // INSERT INTO tabela SET usuario = 'usuario', senha = 'senha', nome = 'nome'
            $dados = array();
            foreach ($data as $key => $value) {
                $dados[] = $key." = '".addslashes($value)."'";
            }
            $sql .= implode(", ",$dados);
            
            $this->pdo->query($sql);
        }
    }
    
    // Aula 25
    public function update($table, $data, $where = array(), $where_cond = "AND")
    {
        if (!empty($table) && (is_array($data) && count($data) > 0) && is_array($where)) {
            $sql = "UPDATE ".$table." SET ";
            $dados = array();
            foreach ($data as $key => $value) {
                $dados[] = $key." = '".addslashes($value)."'";
            }
            $sql .= implode(", ",$dados);
            
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $key => $value) {
                    $dados[] = $key." = '".addslashes($value)."'";
                }
                $sql .= " WHERE ".implode(" ".$where_cond." ",$dados);
            }
        }
        
        $this->pdo->query($sql);
    }
    
    // Aula 26
    public function delete($table, $where, $where_cond = "AND")
    {
        if (!empty($table) && (is_array($where) && count($where) > 0)) {
            $sql = "DELETE FROM ".$table;
            if (count($where) > 0) {
                $dados = array();
                foreach ($where as $key => $value) {
                    $dados[] = $key." = '".addslashes($value)."'";
                }
                $sql .= " WHERE ".implode(" ".$where_cond." ",$dados);
            }            
        }
        
        $this->pdo->query($sql);
    }
}

?>