<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
// Basicamente busca todos usuários que executaram ações nos ultimos 5 minutos.

try {
    $pdo = new PDO("pgsql:dbname=projeto_usuariosonline;host=10.76.64.83","postgres","&kVyhG<({t}[");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExcetption $e)
{
    echo "ERROR:".$e->getMessage();
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'];
$hora = date('H:i:s');


$sql = "INSERT INTO acessos(ip,hora) VALUES (:ip,:hora)";
$query = $pdo->prepare($sql);
$query->bindValue(":ip",$ip);
$query->bindValue(":hora",$hora);
$query->execute();

$query = $pdo->prepare("DELETE FROM acessos WHERE hora < :hora");
$query->bindValue(":hora",date("H:i:s", strtotime("-5 minutes")));
$query->execute();


$sql = "SELECT * FROM acessos WHERE hora > :hora GROUP BY ip, id";
$query = $pdo->prepare($sql);
$query->bindValue(":hora",date("H:i:s", strtotime("-5 minutes")));
$query->execute();
$total = $query->rowCount();


echo "ONLINE: ".$total;
?>