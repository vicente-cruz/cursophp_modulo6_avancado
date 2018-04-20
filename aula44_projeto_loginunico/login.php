<?php
session_start();
require 'config.php';

// Se foi para o login é porque ninguém está logado. Se for o caso, limpa o lixo.
$_SESSION['lg'] = '';

if (isset($_POST['email']) && ( ! empty($_POST['email']))) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = MD5(:senha)";
    $query = $pdo->prepare($sql);
    $query->bindValue(":email",$email);
    $query->bindValue(":senha",$senha);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $usuario = $query->fetch();
        $id = $usuario['id'];
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $_SESSION['lg'] = $id;
        
        $sql = "UPDATE usuarios SET ip = :ip WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(":ip",$ip);
        $query->bindValue(":id",$id);
        $query->execute();
        
        header("Location: index.php");
        exit;
    }
}
?>
<h1>Login</h1>
<form method="POST">
    E-mail:<br/>
    <input type="email" name="email" /><br/><br/>
    
    Senha:<br/>
    <input type="password" name="senha" /><br/><br/>
    
    <input type="submit" value="Enviar" />
</form>