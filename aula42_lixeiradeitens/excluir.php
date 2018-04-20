<?php
require "config.php";

if ( ! empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $query = $pdo->prepare("UPDATE usuarios SET status = '0' WHERE id = :id");
    $query->bindValue(":id",$id);
    $query->execute();
}

header("Location: index.php");
exit;
?>