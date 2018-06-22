<?php
session_start();

global $pdo;
try {
    $pdo = new PDO("pgsql:dbname=classificados;host=10.76.64.83","postgres","&kVyhG<({t}[");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExceptio $e)
{
    echo "ERROR:".$e->getMessage();
    exit;
}

?>