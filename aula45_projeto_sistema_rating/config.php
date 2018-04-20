<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

try {
    $pdo = new PDO("pgsql:dbname=projeto_rating;host=10.76.64.83","postgres","&kVyhG<({t}[");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "ERROR:".$e->getMessage();
    exit;
}
?>