<?php 
$NombreArchivo="FotoPrueba.jpg";
$dir="";

RedimensionarImagen($NombreArchivo,$dir.$NombreArchivo,800,600,"10.75648348","-74.2843845");

/*if(!RedimensionarImagen($NombreArchivo,$dir.$NombreArchivo,800,600)){
	echo "Error al redimensionar el archivo ".$NombreArchivo;
}else{
	echo "Exito!";
}*/

function RedimensionarImagen(&$pNombreimg, $rutaimg, $xmax, $ymax, $Lat="", $Long=""){  
	try{
		
	$nombreimg=$pNombreimg;
	$expl=explode('.',$nombreimg);
	$ext = end($expl);

	if($ext == "jpg" || $ext == "jpeg")  
		$imagen = imagecreatefromjpeg($rutaimg);
	elseif($ext == "png")  
		$imagen = imagecreatefrompng($rutaimg);  
	elseif($ext == "gif")  
		$imagen = imagecreatefromgif($rutaimg);  

	$x = imagesx($imagen);  
	$y = imagesy($imagen);  

	/*if($x <= $xmax && $y <= $ymax){
		//echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
		return $imagen;
	}*/

	if($x >= $y) {
		$nuevax = $xmax;  
		$nuevay = $nuevax * $y / $x;  
	}  
	else {
		$nuevay = $ymax;  
		$nuevax = $x / $y * $nuevay;  
	}
	
	//Agregar estampa de posición GPS
	if($Lat!=""&&$Long!=""){		
		$estampa = imagecreatetruecolor($xmax, 70);
		imagestring($estampa, 5, 20, 20, 'Latitud: '.$Lat, 0xFFFF2B);
		imagestring($estampa, 5, 20, 40, 'Longitud: '.$Long,0xFFFF2B);
		$margen_dcho = 10;
		$margen_inf = 10;
		$sx = imagesx($estampa);
		$sy = imagesy($estampa);
	}	
		

	$img2 = imagecreatetruecolor($nuevax, $nuevay);
	imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
		
	if($Lat!=""&&$Long!=""){
		imagecopymerge($img2, $estampa, imagesx($img2) - $sx - $margen_dcho, imagesy($img2) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa), 50);
	}
		
	imagejpeg($img2, $rutaimg);
	//unlink($archivos_carpeta);
	//echo "<center>La imagen se ha optimizado correctamente.</center>";
	//return $img2;
		
	}catch (Exception $e) {
		echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
	}
	
}


?>