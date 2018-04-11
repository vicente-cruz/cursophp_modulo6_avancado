<?php
/**
 * Mostrando de 10 em 10
 * 0: 1 - 10 / 1: 11 - 20 / ...
 */

try {
    $pdo = new PDO("mysql:dbname=curso_php;host=localhost","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die($e->getMessage());
}

// Busca qtde de registros
$qt_por_pagina = 10;
$query = $pdo->query("SELECT COUNT(*) as c FROM usuarios");
$query = $query->fetch();
$total = $query['c'];

// Define o total de paginas
$paginas = ceil($total/$qt_por_pagina);

// Define a pagina atual
$pg = '1';
if (isset($_GET['p']) && !empty($_GET['p'])) {
    $pg = addslashes($_GET['p']);
}
$p = ($pg - 1) * $qt_por_pagina;

// Busca os registros de acordo com a pagina atual;
$sql = "SELECT * FROM usuarios LIMIT ".$p.", $qt_por_pagina";
$query = $pdo->query($sql);
if ($query->rowCount() > 0) {
    foreach ($query->fetchAll() as $usuario) {
        echo $usuario['email'].' - '.$usuario['senha'].' - '.$usuario['nome'].'<br>';
    }
}

// Mostra a paginacao
echo "<hr>";
for ($q=0;$q<$paginas;$q++) {
    echo "<a href='aula32_paginacao.php?p=".($q+1)."'>[".($q+1)."]</a>";
}

// Para popular a tabela
//$sql = "INSERT INTO usuarios(email,senha,nome,data) VALUES (?,?,?,?)";
//for ($i = 0; $i < 200; $i++) {
//    $query = $pdo->prepare("INSERT INTO usuarios(email,senha,nome,data) VALUES (?,?,?,?)");
//    $query->execute(array(
//        'user'.$i.'@email.com',
//        md5('123'.$i),
//        'Usuario'.$i,
//        date("d/m/Y H/i/s")
//    ));
//}
//echo "FIM!<br>";

?>