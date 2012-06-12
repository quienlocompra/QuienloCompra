<?php
// Perfil de usuario

include("config.php");

$appID = 'appid_wtftrtcy';
$appKey = 'bcd9e33946ed32f06cfcb06bca932385';
$aQuien = isset($_GET['u']) ? $_GET['u'] : 'dannegm';

$data = file_get_contents( "http://".domain.'/apps/api.php?ID=' . $appID . '&Key=' . $appKey . '&user=' . $aQuien );
$data = json_decode($data);
$user = $data->user;
?>
<!DOCTYPE html>
<html lang="es-Mx">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/old.css" />
	<title><?php echo $user->username; ?> en Quienlocompra</title>
</head>
<body>
	<header>
		<hgroup>
			<h1>Quien lo compra</h1>
		</hgroup>
	</header>

	<div id="wrap">
		<aside>
			<figure>
				<img src="<?php echo $user->pic; ?>" />
				<figcaption>
					<span><?php echo $user->name; ?></span>
					<span>@<?php echo $user->username; ?></span>
				</figcaption>
			</figure>
			<article id="bio">
				<?php echo $user->bio; ?>
			</article>
		</aside>
		<section>
		</section>
	</div>
</body>
</html>