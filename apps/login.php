<?php
// Login
include_once('../class/user.php');
include_once('../class/app.php');

$appID = isset($_GET['ID']) ? $_GET['ID'] : 'undefined';
$user = isset($_POST['user']) ? $_POST['user'] : 'undefined';
$pass = isset($_POST['pass']) ? $_POST['pass'] : 'undefined';

$app = new App ();
$app->setID( $appID );
$us = new User ();
$us->setUser( $user );

$app->addUser( $us->uid() );
$us->addApp( $appID );

if ( $us->login($pass) ){
	echo 'login ' . $us->consult('user');
}else{
	echo $us->error();
}
$app->close();
$us->close();
?>
<script> window.close(); </script>
