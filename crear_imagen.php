<?php
// Cargar la estampa y la foto para aplicarle la marca de agua
$im = imagecreatefromjpeg('FotoPrueba.jpg');

// Primero crearemos nuestra imagen de la estampa manualmente desde GD
$estampa = imagecreatetruecolor(337, 70);
//imagefilledrectangle($estampa, 0, 0, 99, 69, 0x0000FF);
//imagefilledrectangle($estampa, 9, 9, 90, 60, 0xFFFFFF);
//imagefilledrectangle($estampa, 0, 0, 99, 69, 0xFFFFFF);
imagestring($estampa, 5, 20, 20, 'Latitud: 10.78465738', 0xFFFF2B);
imagestring($estampa, 5, 20, 40, 'Longitud: -74.1856473',0xFFFF2B);

// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = 10;
$margen_inf = 10;
$sx = imagesx($estampa);
$sy = imagesy($estampa);

// Fusionar la estampa con nuestra foto con una opacidad del 50%
imagecopymerge($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa), 50);

// Guardar la imagen en un archivo y liberar memoria
imagepng($im, 'foto_estampa.png');
imagedestroy($im);

?>
