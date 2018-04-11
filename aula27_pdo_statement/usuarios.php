<?php
class Usuarios
{
    private $db;
    
    public function __construct() {
        try {
            $this->db = new PDO("mysql:dbname=curso_php;host=localhost","root","");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            
        }
    }
    
    public function select($id)
    {
//        $sql = "SELECT * FROM usuarios WHERE id='".$id."'";
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id= :id");
        // bindValue: associa o "valor" de id... se mudar $id, conteudo nao altera
        $sql->bindValue(":id",$id);
        $sql->execute();
        
        $result = array();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetch();
        }
        
        return $result;
    }
    
    public function insert($usuario,$senha,$nome,$email)
    {
        $sql = $this->db->prepare("INSERT INTO usuarios SET nome = :nome, usuario = :usuario, senha = :senha, email = :email");
        // bindParam: amarra a variavel toda! se $nome mudar antes do execute, entao :nome guarda o valor mudado
        $sql->bindParam(":nome", $nome);
        $sql->bindParam(":usuario", $usuario);
        $sql->bindValue(":senha", md5($senha));
        $sql->bindParam(":email", $email);
        $sql->execute();
    }
    
    public function update($usuario,$senha,$nome,$email,$id)
    {
        $sql = $this->db->prepare("UPDATE usuarios SET usuario = ?, senha = ?, nome = ?, email = ? WHERE id = ?");
        $sql->execute(array($usuario, md5($senha), $nome, $email, $id));
    }
    
    public function delete($id)
    {
        $sql = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        $sql->bindValue(1, $id);
        $sql->execute();
    }
}
?>