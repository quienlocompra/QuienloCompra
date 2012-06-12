<?php

function resizeImg ($img, $width = 200){

	$image_type = explode(".", $img);
	$image_type = end($image_type);

	if ( preg_match('/jp/i', $image_type) ) { $image_type = "jpeg"; }

	header("Content-Type: image/" . $image_type);

	list($width_o, $height_o) = getimagesize( $img );
	
	$height = $height_o;

	$ratio_o = $width_o /$height_o;

	if ( $width / $height > $ratio_o ) {
	   $width = $height * $ratio_o;
	} else {
	   $height = $width /$ratio_o;
	}
    

	$image_p = imagecreatetruecolor( $width, $height );

	switch ( $image_type ){
		case "jpeg": $image = imagecreatefromjpeg( $img ); break;
		case "png": $image = imagecreatefrompng( $img ); break;
		case "gif": $image = imagecreatefromgif( $img ); break;
	}

	imagealphablending($image_p, false); imagesavealpha($image_p, true);
	imagecopyresampled( $image_p, $image, 0, 0, 0, 0, $width, $height, $width_o, $height_o );

	switch ( $image_type ){
		case "jpeg": imagejpeg($image_p, null, 100); break;
		case "png":  imagepng($image_p); break;
		case "gif": imagegif($image_p); break;
	}
	
	imagedestroy($image);
	imagedestroy($image_p);
	
}

$p = isset($_GET["p"]) ? $_GET["p"] : "img/fondo.jpg";
$w = isset($_GET["w"]) ? $_GET["w"] : 200;

resizeImg($p, $w);
