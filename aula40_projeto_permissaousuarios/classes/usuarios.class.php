<?php
class Usuarios {
    
    private $pdo;
    private $id;
    private $permissoes;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function fazerLogin($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":email",$email);
        $query->bindValue(":senha",$senha);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $usuario = $query->fetch();
            
            $_SESSION['logado'] = $usuario['id'];
            
            return true;
        }
        else {
            return false;
        }
    }
    
    public function setUsuario($id)
    {
        $this->id = $id;
        
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id",$id);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $usuario = $query->fetch();
            $this->permissoes = explode(',',$usuario['permissoes']);
            
        }
    }
    
    public function getPermissoes()
    {
        return $this->permissoes;
    }
    
    public function temPermissao($p)
    {
        if (in_array($p, $this->permissoes)) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>