<?php
require 'config.php';
if (empty($_SESSION['cLogin'])) {
    header("Location: login.php");
    exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();

if (isset($_GET['id']) && ( ! empty($_GET['id']))) {
    $id = addslashes($_GET['id']);
    $a->deleteAnuncio($id);
}

header("Location: meus-anuncios.php");
?>