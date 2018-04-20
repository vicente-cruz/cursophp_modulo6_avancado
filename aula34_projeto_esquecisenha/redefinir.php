<?php
require "config.php";

if (isset($_GET['token']) && ( ! empty($_GET['token']))) {
    $token = $_GET['token'];
    
    $sql = "SELECT * FROM usuarios_token WHERE hash = :hash AND used = 0 AND expirado_em > NOW()";
    $query = $pdo->prepare($sql);
    $query->bindValue(":hash",$token);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $dado = $query->fetch();
        $id = $dado['id_usuario'];
        
        if (isset($_POST['senha']) && ( ! empty($_POST['senha']))) {
            $senha = md5($_POST['senha']);
            
            $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindValue(":senha", $senha);
            $query->bindValue(":id", $id);
            $query->execute();
            
            $sql = "UPDATE usuarios_token SET used = 1 WHERE hash = :hash";
            $query = $pdo->prepare($sql);
            $query->bindValue(":hash", $token);
            $query->execute();
            
            echo "Senha alterada com sucesso";
            exit;
        }
?>
<form method="POST">
    Digite a nova senha:<br/>
    <input type="password" name="senha" /><br/>
    <input type="submit" value="Mudar senha"/>
</form>
<?php
    }
    else {
        echo "Token inválido ou já usado";
        exit;
    }
}
?>