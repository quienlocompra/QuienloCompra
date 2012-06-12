<?php
	$appID = isset($_GET['ID']) ? $_GET['ID'] : 'undefined';
?>
<!DOCTYPE html>
<html lang="es-Mx">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/dialog.css" />
	<title>Iniciar sesión</title>

	<script src="../js/jquery.js"></script>
	<script src="../api.js"></script>
	<script>
		jQuery(function(){
			$('#msgTitle').text( document.title );

			$('#msgCancel').click(function(e){
				e.preventDefault();
				window.close();
			});
		});
	</script>
</head>
<body>
<style id="msgStyle">
	* {
		margin: 0;
		padding: 0;
		font-family: sans-serif;
	}
	.msgLogo {
		display: block;
		overflow: hidden;
		background:  rgb(186,0,1) url("http://dannegm/www/quienlocompra/img/miniLogo.png") no-repeat left center;
		height: 40px;
		text-indent: -99999px;
	}
	.sprite {
		display: block;
		height: 10px;
		background: url("http://dannegm/www/quienlocompra/img/spritered.png");
	}
	#msgTitle {
		font-size: 16px;
		color: #222;
		background: #eee;
		margin: 0px;
		padding: 10px;
	}
	#msgContent { 
		color: #444; 
		display: block; 
		overflow: hidden; 
		font: 14px/1.4 sans-serif; 
		padding: 10px; 
		background: #fff; 
	}
	.center {
		width: 500px;
		margin:  30px auto;
		overflow: hidden;
	}
	#msgOptions { 
		display: block; 
		overflow: hidden; 
		background: rgb(217,217,217) !important;
		padding: 5px;
		position: absolute;
		bottom: 0; left: 0; right: 0;
	} 
	#msgOptions a, #msgOptions button { 
		text-decoration: none; 
		color: #000; 
		font: 12px sans-serif; 
		display: block; 
		float: right; 
		margin: 5px; 
		padding: 5px 7px; 
		border: 1px solid rgb(127,127,127); 
		background: #eee; 
		background: -webkit-linear-gradient(top, rgb(242,242,242) 0%,rgb(217,217,217) 100%); 
		border-radius: 3px; 
	} 
	#msgOptions a:focus, #msgOptions button:focus { 
		outline: none; 
		box-shadow: 0 0 3px rgb(38,125,230); 
	} 
	#msgOptions a:hover, #msgOptions button:hover { 
		background: #fff; 
		background: -webkit-linear-gradient(top, rgb(255,255,255) 0%,rgb(242,242,242) 100%); 
	} 
	#msgOptions a:active, #msgOptions button:active { 
		background: rgb(242,242,242); 
	} 
	#msgOptions button.hot { 
		color: #fff; 
		background: rgb(149,55,53); background: -webkit-linear-gradient(top, rgb(149,55,53) 0%, rgb(99,37,35) 100%); 
	} 
		#msgOptions button.hot:hover { 
			background: rgb(192,80,77); background: -webkit-linear-gradient(top, rgb(192,80,77) 0%, rgb(149,55,53) 100%); 
		} 
		#msgOptions button.hot:active { 
			background: rgb(149,55,53); 
		}

	.left {
		float: left;
		width: 300px;
		border-right: 5px solid rgb(191,191,191);
	}
	.right {
		width: 145px;
		min-height: 100px;
		float: right;
		padding-left: 50px;
		background: url('../img/left_grey_arrow.png') no-repeat;
	}

	input {
		display: block;
		margin: 10px;
		border: 1px solid rgb(166,166,166);
		padding: 5px 3px;
		width: 260px;
	}
	input[type="checkbox"] {
		display: inline;
		margin: 5px 0px;
		width: auto;
	}
	label {
		font-size: 12px;
		color: rgb(89,89,89);
	}
	.left div {
		margin: 10px 10px 5px 10px;
	}
	.left a {
		font-size: 12px;
		margin: 0px 10px;
		color: rgb(31,73,125);
		text-decoration: none;
	}

	figure {
		display: block;
	}
	figure img {
		display: block;
		width: 80px;
		height: 80px;
		margin: 10px auto;
	}
	figure figcaption {
		text-align: center;
		color: rgb(31,73,125);
	}
</style>
	<div class="msgLogo"></div><div class="sprite"></div>
		<div id="msgTitle"></div>
		<form action="login.php?ID=<?php echo $appID; ?>" method="post">
			<div id="msgContent">
				<div class="center">
					<div class="left">
						<input type="text" name="user" placeholder="Usuario" />
						<input type="password" name="pass" placeholder="Contraseña" />
						<div>
							<input type="checkbox" name="keeplogged" value="keep" checked />
							<label for="keeplogged">Mantenerme conectado</label>
						</div>
						<a href="request_password.php">¿Olvidaste tu contrasea?</a>
					</div>
					<div class="right">
						<figure>
							<img src="../img/example_app.png" />
							<figcaption>
								Dannegm Development
							</figcaption>
						</figure>
					</div>
				</div>
			</div>
			<div id="msgOptions">
				<button id="msgOk" class="hot" href="#">Entrar</button><a id="msgCancel" href="#">Cancelar</a>
			</div>
		</form>
</body>
</html>