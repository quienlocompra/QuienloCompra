<?php
// Logout
include_once('../class/user.php');

$user = isset($_POST['user']) ? $_POST['user'] : 'undefined';
$app = new User ();
$app->setUser($user);
$app->logout();
$app->close();
?>