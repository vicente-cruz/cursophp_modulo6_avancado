<?php

$image_name = "phoenix.jpg";
list($original_width, $original_height) = getimagesize($image_name);
$original_image = imagecreatefromjpeg($image_name);

$mini_image_name = "mini_phoenix.jpg";
list($mini_width, $mini_height) = getimagesize($mini_image_name);
$mini_image = imagecreatefromjpeg($mini_image_name);

$final_image = imagecreatetruecolor($original_width, $original_height);

imagecopy($final_image, $original_image, 0, 0, 0, 0, $original_width, $original_height);
imagecopy($final_image, $mini_image, 100, 200, 0, 0,$mini_width, $mini_height);

//header("Content-Type: image/jpg");
//imagejpeg($final_image, NULL, 85);
imagejpeg($final_image, "phoenix_watermark.jpg", 85);
echo "Marca d'agua criada com sucesso";

?>