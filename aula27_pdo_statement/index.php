<?php
require "usuarios.php";

$usuario = new Usuarios();
//$usuario->insert("user_pdo", "pdo123", "Usuario PDO_Statement", "pdo_statement@email.com");
//$usuario->update("user_pdo_updated", "pdo123_updated", "Usuario PDO_Statement Updated", "pdo_statement_updated@email.com",6);
$usuario->delete(6);
print_r($usuario->select(6));
