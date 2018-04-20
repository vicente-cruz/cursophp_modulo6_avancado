<?php
session_start();

if ( ! isset($_SESSION['captcha'])) {
    $n = rand(1000, 9999);
    $_SESSION['captcha'] = $n;   
}

if ( ! empty($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $codigo = $_POST['codigo'];
    
    if ($codigo == $_SESSION['captcha']) {
        echo "Logado com sucesso!<br/>";
    }
    else {
        echo "Digite o código novamente!<br/>";
    }
    
    $n = rand(1000, 9999);
    $_SESSION['captcha'] = $n;
}
?>

<form method="POST">
    
    E-mail:
    <input type="text" name="email" /><br/><br/>
    
    Senha:
    <input type="password" name="senha" /><br/><br/>
    
    
    <img src="imagem.php" width="100" height="50" /><br/>
    <input type="text" name="codigo" /><br/><br/>
    
    <input type="submit" value="Verificar" />
</form>