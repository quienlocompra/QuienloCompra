<?php
session_start();
	header('Content-Type: image/png');
	$randomCaracteres = "1234567890abcdefghijklmnopqrstuvwxyz";
	$captchaTxt = "";
	for ( $i = 0; $i < 8; $i++ ){
		$captchaTxt .= $randomCaracteres{ rand(0,35) };
	}
	$_SESSION["captcha"] = $captchaTxt;

	$captchaFont = "../fonts/captcha.ttf";

	$captchaImage = imagecreatetruecolor(210, 50);

	// Crear algunos colores
	$background = imagecolorallocate($captchaImage, 255, 255, 255);
	$fontcolor = imagecolorallocate($captchaImage, 0, 0, 0);
	imagefilledrectangle($captchaImage, 0, 0, 209, 49, $background);

	// Parametros ( $tamaño, $inclinacion, $left, $top, $colorDeFuente, $tipoDeFuente, $texto);
	imagettftext($captchaImage, 40, 0, 20, 40, $fontcolor, $captchaFont, $captchaTxt);
	imagepng($captchaImage);
	imagedestroy($captchaImage);
?>