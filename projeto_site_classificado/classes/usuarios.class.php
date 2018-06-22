<?php

class Usuarios {
    
    public function cadastrar($nome, $email, $senha, $telefone = "")
    {
        global $pdo;
        $query = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $query->bindValue(":email",$email);
        $query->execute();
        
        if ($query->rowCount() == 0) {
            $query = $pdo->prepare("INSERT INTO usuarios(nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)");
            $query->bindValue(":nome",$nome);
            $query->bindValue(":email",$email);
            $query->bindValue(":senha",md5($senha));
            $query->bindValue(":telefone",$telefone);
            $query->execute();
            
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getTotalUsuarios()
    {
        global $pdo;
        
        $query = $pdo->query("SELECT COUNT(*) AS c FROM usuarios");
        $row = $query->fetch();
        
        return $row['c'];
    }
    
    public function login($email, $senha)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT id, nome FROM usuarios WHERE email = :email AND senha = :senha");
        $query->bindValue(":email",$email);
        $query->bindValue(":senha",md5($senha));
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $usuario = $query->fetch();
            $_SESSION['cLogin'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            
            return true;
        }
        else {
            return false;
        }
    }
}
