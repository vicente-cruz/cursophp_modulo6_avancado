<?php
session_start();
require 'config.php';

if (empty($_SESSION['lg'])) {
    header("Location: login.php");
    exit;
}
else {
    $id = $_SESSION['lg'];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $sql = "SELECT * FROM usuarios WHERE id = :id AND ip = :ip";
    $query = $pdo->prepare($sql);
    $query->bindValue(":id",$id);
    $query->bindValue(":ip",$ip);
    $query->execute();
    
    if ($query->rowCount() == 0) {
        header("Location: login.php");
        exit;
    }
}
?>
<h1>Conteúdo Confidencial</h1>
