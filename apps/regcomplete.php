<?php
include_once('../config.php');
include_once('../functions.php');
include_once('../class/user.php');

session_start();

$do = isset($_POST['do']) ? $_POST['do'] : 'not';

if ( $do == 'it' ){

	$name = isset($_POST['name']) ? $_POST['name'] : 'undefined';
	$bird = isset($_POST['birddate']) ? $_POST['birddate'] : 'undefined';
	$gen = isset($_POST['gen']) ? $_POST['gen'] : 'undefined';
	$country = isset($_POST['country']) ? $_POST['country'] : 'undefined';
	$type = isset($_POST['type']) ? $_POST['type'] : 'undefined';

	$data = Array(
		'name' => $name,
		'bird' => $bird,
		'gen' => $gen,
		'country' => $country,
		'type' => 'type'
	);
	$user = new User ();
	$user->setUid( $_SESSION['uid'] );
	$user->regcomplete( $data );
	$username = $user->consult('user');
	$user->close();
	$_SESSION['doreg'] = 'off';
	header('Location: ../perfil.php?u=' . $username );
}else{
	header('Location: ../');
}
?>