<?php
include_once('../config.php');
include_once('../functions.php');
include_once('../class/user.php');
include_once('../class/app.php');

session_start();

$appID = 'appid_wtftrtcy';
$appKey = 'bcd9e33946ed32f06cfcb06bca932385';

$app = new App();
$app->setID( $appID );
$app->setKey( $appKey );

$newUser = new User ();

$user = isset($_POST['user']) ? $_POST['user'] : 'undefined';
$pass = isset($_POST['pass']) ? $_POST['pass'] : 'undefined';
$email = isset($_POST['email']) ? $_POST['email'] : 'undefined';
$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : 'undefined';

if ( $captcha == $_SESSION['captcha'] ){
	if ( $user == 'undefined' ){
		echo 'error 2'; // No se recibio usuario
	}elseif( $newUser->exist( $user ) ){
		echo 'error 3'; // Usuario ya existe
	}elseif( $pass == 'undefined' ){
		echo 'error 4'; // No se recibio contraseña
	}elseif( $email == 'undefined' ){
		echo 'error 5'; // No se recibio email
	}else{
		$datos = Array(
			'user' => $user,
			'pass' => $pass,
			'email' => $email
		);
		$reg = $newUser->register( $datos );
		if( $reg ){
			$_SESSION['doreg'] = 'on';
			$_SESSION['uid'] = $newUser->uid();
			$app->addUser( $newUser->uid() );
			$newUser->addApp( $appID );
			echo 'success 0'; // Exito!
		}else{
			echo 'error ?'; // Error inesperado
		}
	}
}else{
	echo 'error 1'; // El captcha no coincide
}

$app->close();
$newUser->close();
?>