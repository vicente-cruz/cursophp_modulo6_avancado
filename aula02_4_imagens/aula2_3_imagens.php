<?php

$image = "phoenix.jpg";

$width = 200;
$height = 200;

list($original_width, $original_height) = getimagesize($image);
$ratio = $original_width / $original_height;

if ($width/$height > $ratio) {
    $width = $width * $ratio;
} else {
    $height = $height / $ratio;
}

//echo "L. Original: ".$original_width." - A. Original: ".$original_height."<br>";
//echo "LARGURA: ".$width." - ALTURA: ".$height."<br>";

$final_image = imagecreatetruecolor($width, $height);
$original_image = imagecreatefromjpeg($image);

imagecopyresampled(
        $final_image, $original_image,
        0, 0, 0, 0,
        $width, $height,
        $original_width, $original_height
);

//header("Content-Type: image/jpg");
//imagejpeg($final_image, NULL, 85);
imagejpeg($final_image, "mini_phoenix.jpg", 85);

echo "Imagem redimensionada com sucesso!";
?>