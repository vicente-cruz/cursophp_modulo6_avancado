<?php
require "config.php";

if (isset($_POST['email']) && ( ! empty($_POST['email']))) {
    $email = addslashes($_POST['email']);
    
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $query->bindValue(":email",$email);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $dado = $query->fetch();
        $id = $dado['id'];
        
        $token = md5(time().rand(0,99999).rand(0,99999));
        
        $query = $pdo->prepare("INSERT INTO usuarios_token(id_usuario,hash,expirado_em) VALUES (:id_usuario,:hash,:expirado_em)");
        $query->bindValue(":id_usuario", $id);
        $query->bindValue(":hash", $token);
        $query->bindValue(":expirado_em", date("Y-m-d H:i", strtotime("+2 months")));
        $query->execute();
        
        $link = "http://cursophp.pc/modulo6_avancado/aula34_projeto_esquecisenha/redefinir.php?token=".$token;
        
        $mensagem = "Clique no link para redefinir sua senha:<br/>".$link;
        $assunto = "Redefinição de senha";
        $headers = "From: meuemail@meusite.com.br"."\r\n"."X-Mailer: PHP/".phpversion();
        //mail($email, $assunto, $mensagem, $headers);
        echo $mensagem;
        exit;
        
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Projeto - Esqueci minha senha</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"/>
        <script type="text/javascript" src="../../assets/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../assets/font-awesome-4.7.0/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Formulário de Reinicialização de Senha</h1>
                </div>
                <div class="panel-body">
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                <input type="email" name="email" placeholder="Qual o seu e-mail?" class="form-control"/>
                            </div>
                        </div>
                        
                        <input type="submit" value="Enviar" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>