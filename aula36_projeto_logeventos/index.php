<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require "historico.class.php";

$log = new historico();
$log->registrar("Entrou na página inicial.");

$log->mostrarRegistros();

?>