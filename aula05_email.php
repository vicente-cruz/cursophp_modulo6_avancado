<?php
if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $msg = addslashes($_POST['msg']);
    
    $to = "contato@vicentecruz.com.br";
    $subject = "Teste aula e-mail";
    $body = "Nome: ".$nome." - E-mail: ".$email." - Mensagem: ".$msg;
    $header = "From: pessoal@vicentecruz.com.br\r\n".
              "Reply-To: ".$email."\r\n".
              "X-Mailer: PHP/".  phpversion();
    mail($to, $subject, $body, $header);
    
    echo "<h2>E-mail enviado com sucesso!</h2>";
}
?>

<form method="POST">
    Nome:<br>
    <input type="text" name="nome"><br><br>
    
    E-mail:<br>
    <input type="text" name="email"><br><br>
    
    Mensagem:<br>
    <textarea name="msg"></textarea><br><br>
    
    <input type="submit" value="Enviar">
</form>