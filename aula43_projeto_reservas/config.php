<?php

try {
    $pdo = new PDO("pgsql:dbname=projeto_reservas;host=10.76.64.83","postgres","&kVyhG<({t}[");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "ERROR:".$e.getMessage();
    exit;
}

?>