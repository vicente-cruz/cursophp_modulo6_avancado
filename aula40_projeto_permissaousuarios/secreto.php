<?php
session_start();
require "config.php";
require "classes/usuarios.class.php";
require "classes/documentos.class.php";

if ( ! isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$usuarios = new Usuarios($pdo);
$usuarios->setUsuario($_SESSION['logado']);

if ( ! $usuarios->temPermissao('SECRET')) {
    header("Location: index.php");
}
?>

<h1>Página Secreta</h1>