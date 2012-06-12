<?php
/*
/*			Quienlocompra.com
/*			Propuesta de api desarrollada por Dannegm CC 2012
/*
/*			Vercion del API: 0.3.28.20
/*
/**/
include_once('../config.php');
include_once('../functions.php');
include_once('../class/user.php');
include_once('../class/app.php');
include_once('../class/picture.php');
include_once('../class/article.php');

$appID = isset($_GET['ID']) ? $_GET['ID'] : 'undefined';
$appKey = isset($_GET['Key']) ? $_GET['Key'] : 'undefined';

if ( $appID && $appKey != 'undefined' ){

	$app = new App();
	$app->setID( $appID );
	$app->setKey( $appKey );

	if ( $app->turnAccess() == 'on' ){

		$action = isset($_POST['action']) ? $_POST['action'] : 'get';

		switch ( $action ){
			case 'post':
			break;
			case 'update':
			break;
			case 'get':
				$uid = isset($_GET['user']) ? $_GET['user'] : 'undefined';
				$jsonp = isset($_GET['jsonp']) ? $_GET['jsonp'] : 'false';
				$callback = isset($_GET['callback']) ? $_GET['callback'] : 'undefined';

				$user = new User ();
				$user->setUser($uid);

				$pic = new Picture ();
				$apppic = $pic->geturi( $app->consult('logo') );
				$userpic = $pic->geturi( $user->consult('pic') );

				$article = new Article ();

				if ( $user->consult('login') == '1' ){
					$QlcAPI = Array(
						'app' => Array(
							'ID' => $appID,
							'name' => $app->consult('name'),
							'logo' => dirpic . "/" . $apppic,
							'icon' => $app->consult('icon'),
							'url' => $app->consult('url')
						),
						'user' => Array(
							'uid' => $user->consult('uid'),
							'username' => $user->consult('user'),
							'name' => $user->consult('name'),
							'email' => $user->consult('email'),
							'pic' => dirpic . "/" . $userpic,
							'bio' => $user->consult('bio'),
							'articles' => $article->listArticles( $user->consult('articles') ),
							'followers' => Array(
							),
							'followins' => Array(
							)
						)
					);

					$QlcAPI = json_encode($QlcAPI);
					if ( $jsonp == "true" ){
						$result = $callback  . '(' . $QlcAPI . ');';
					}else{
						$result = $QlcAPI;
					}
					header('Content-type: text/javascript');
					echo $result;
				}else{
					echo "var error = 'Debes iniciar sesión';";
				}
				$pic->close();
				$article->close();
				$user->close();
			break;
		}

	}else{
		echo "var error = '" . $app->error() . "';";
	}

	$app->close();

}else{
	echo "var error = 'Aplicacón desconocida';";
}

?>