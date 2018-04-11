<?php
// Diretorios Virtuais
require "sobre1.php";
require "sobre2.php";

$sobre = new \aplicacao\v2\Sobre();

echo "Versao: ".$sobre->getVersao();
?>