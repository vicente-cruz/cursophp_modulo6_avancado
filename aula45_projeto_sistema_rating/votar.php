<?php
require 'config.php';

if ( ! empty($_GET['id']) && ( ! empty($_GET['voto']))) {
    $id = intval(addslashes($_GET['id']));
    $voto = intval(addslashes($_GET['voto']));
    
    if (($voto > 0) && ($voto <= 5)) {
        $query = $pdo->prepare("INSERT INTO votos(id_filme, nota) VALUES (:id_filme,:nota)");
        $query->bindValue(":id_filme",$id);
        $query->bindValue(":nota",$voto);
        $query->execute();
        
        $sql = " UPDATE "
                . "filmes"
                . " SET "
                . "media = ("
                . "     SELECT "
                . "         (SUM(votos.nota)/COUNT(*))"
                . "     FROM"
                . "         votos"
                . "     WHERE"
                . "         votos.id_filme = filmes.id"
                . ")"
                . " WHERE "
                . "id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(":id",$id);
        $query->execute();
        
        header("Location: index.php");
        exit;
    }
}
?>