<h1>Digite e-mail ou CPF do usuário</h1>
<form method="GET">
    <input type="text" name="campo" />
    <input type="submit" value="Pesquisar" />
</form>

<hr/>
<?php
if (isset($_GET['campo']) && ( ! empty($_GET['campo']))) {
    $campo = $_GET['campo'];
    
    try {
        $pdo = new PDO("pgsql:dbname=projeto_pesquisacolunas;host=10.76.64.83","postgres","&kVyhG<({t}[");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "ERROR:".$e->getMessage();
        exit;
    }
    
    $sql = "SELECT * FROM usuarios WHERE email = :email OR cpf = :cpf OR nome = :nome";
    $query = $pdo->prepare($sql);
    $query->bindValue(":email",$campo);
    $query->bindValue(":cpf",$campo);
    $query->bindValue(":nome",$campo);
    $query->execute();
    
    if ($query->rowCount() > 0) {
        $usuario = $query->fetch();
        
        echo "Nome:".$usuario['nome']."<br/>";
    }
}
?>