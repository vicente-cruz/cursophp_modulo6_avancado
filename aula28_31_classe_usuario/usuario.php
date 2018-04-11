<?php
// Aula 29: Criar classe usuario com getters e setters
class usuario
{
    private $id;
    private $email;
    private $senha;
    private $nome;
    private $data;
    
    private $pdo;
    
    public function __construct($id = "") {
        
        try {
            $this->pdo = new PDO("mysql:dbname=curso_php;host=localhost","root","");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "ERRO: ".$e->getMessage();
        }
        
        if (!empty($id)) {
            
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute(array($id));
            
            if ($sql->rowCount() > 0) {
                $usuario = $sql->fetch();
                $this->id = $usuario['id'];
                $this->email = $usuario['email'];
                $this->nome = $usuario['nome'];
                $this->data = $usuario['data'];
            }
        } else {
            
        }
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function getData() {
        return $this->data;
    }

    public function setSenha($senha) {
        $this->senha = md5($senha);
    }
    
    // Aula 30
    public function salvar()
    {
        //Alterando usuario
        if (!empty($this->id)) {
            $sql = "UPDATE "
                    . "usuarios"
                . " SET "
                    . "email = ?,"
                    . "senha = ?,"
                    . "nome = ?,"
                    . "data = ?"
                . " WHERE id = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute(array(
                $this->email,
                $this->senha,
                $this->nome,
                $this->data,
                $this->id)
            );
        //Novo usuario
        } else {
            $sql = ""
                . "INSERT INTO"
                    . " usuarios"
                . " SET "
                    . "email = ?,"
                    . "senha = ?,"
                    . "nome = ?,"
                    . "data = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute(array(
                $this->email,
                $this->senha,
                $this->nome,
                $this->data)
            );
        }
    }
    
    // Aula 31
    public function delete()
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute(array($this->id));
    }
}
?>