<?php
include_once('../config.php');
include_once('../functions.php');
include_once('../class/user.php');
include_once('../class/picture.php');

session_start();

$do = isset($_POST['do']) ? $_POST['do'] : 'not';

if ( $do == 'it' ){
	$pic = $_FILES["pic"];
	$data = Array(
		'author' => $_SESSION['uid'],
		'title' => '',
		'description' => '',
		'pic' => $pic
	);
	$newPic = new Picture ();
	$newPic->newpic( $data );

	$user = new User ();
	$user->setUid( $_SESSION['uid'] );
	$user->setpic( $newPic->pid() );
	$user->close();

	$_SESSION['pic'] = $newPic->pid();

	$newPic->close();
}


$ispic = isset($_SESSION['pic']) ? $_SESSION['pic'] : 'no';
$picture = '';
if ( $ispic == 'no' ){
	$picture = '../img/nopic.png';
}else{
	$piki = new Picture ();
	$picture = dirpic . "/" . $piki->geturi( $ispic );
	$_SESSION['pic'] = 'no';
}
?>
<!DOCTYPE html>
<html lang="es-Mx">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="../css/uniform.css" />
	<title>Quienlocompra.com</title>

	<script src="../js/jquery.js"></script>
	<script src="../js/uniform.js"></script>
	<script>
		jQuery(function(){
			$('input:file').uniform();
			$('[name="pic"]').change(function(){
				$('form').submit();
			});
		});
	</script>
	<style>
		img {
			display: block;
			margin: 10px 5px;
			border: 1px solid rgb(166,166,166);
			box-shadow: 0px 1px 1px rgba(0,0,0,.7);
			max-width: 250px;
			max-height: 250px;
		}
	</style>
</head>
<body>
	<form action="#" method="post" enctype="multipart/form-data">
		<input type="hidden" name="do" value="it" />
		<input type="file" name="pic" />
		<img src="<?php echo $picture; ?>" />
	</form>
</body>
</html>