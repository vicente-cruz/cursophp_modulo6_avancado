<?php

try {
    $pdo = new PDO(
            "pgsql:dbname=curso_php;host=localhost",
            "root",
            ""
    );
}
catch(PDOException $e) {
    echo "ERRO:".$e.getMessage();
    exit;
}

?>