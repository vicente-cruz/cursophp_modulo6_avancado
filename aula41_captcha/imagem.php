<?php
session_start();
header("Content-Type: image/jpeg");

$n = $_SESSION['captcha'];

$imagem = imagecreate(100, 50);

// Define a cor cinza para a imagem e a 
imagecolorallocate($imagem, 200, 200, 200);

$fontcolor = imagecolorallocate($imagem,20,20,20);
imagettftext($imagem, 40, 0, 22, 35, $fontcolor, 'Ginga.otf', $n);

// Transforma a imagem em .jpg (qualidade 100%)
imagejpeg($imagem, null, 100);
?>