<!DOCTYPE html>
<html id="index" lang="es-Mx">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/default.css" />
	<link rel="stylesheet" href="css/uniform.css" />
	<title>Quienlocompra.com</title>

	<script src="js/jquery.js"></script>
	<script src="js/uniform.js"></script>
	<script src="js/utils.js"></script>
	<script>
		jQuery(function(){
			$('input:checkbox').uniform();
			var captcha = $('#captcha');
			captcha.click(function(){ captcha.attr('src', 'apps/captcha.php'); });

			var register = $('#register');
			register.submit(function(e){
				e.preventDefault();
				var user = $('#register [name="user"]').val(),
					email = $('[name="email"]').val(),
					pass = $('#register [name="pass"]').val(),
					captch = $('[name="captcha"]').val();
				if ( user == '' ){
					$alert('Escribe un nombre de usuario');
				}else if ( email == '' ){
					$alert('Escribe un email valido');
				}else if ( pass == '' ){
					$alert('Escribe una contraseña');
				}else if ( captch == '' ){
					$alert('Escribe el texto que vez en la imágen');
				}else{
					jQuery.post('apps/app.register.php',{
							user: user,
							email: email,
							pass: pass,
							captcha: captch
						},function(r){
							var res = r.split(' ');
							if ( res[0] == 'error' ){
								var errno = res[1];
								switch( errno ){
									case '1': $alert('El texto no coincide con la imágen'); break;
									case '2': $alert('No se recibio nombre de usuario'); break;
									case '3': $alert('El usuario <strong>' + user + '</strong> ya existe'); break;
									case '4': $alert('No se recibio contraseña'); break;
									case '5': $alert('No se recibio email'); break;
									case '?': $alert('Ha ocurrido un error inesperado, intentelo nuevamente'); break;
								}
							}else if ( res[0] == 'success' ){
								window.location.href = 'apps/register.php';
							}else{
								$alert('Ha ocurrido un error inesperado, intentelo nuevamente');
							}
						}
					);
				}
			});
		});
	</script>
</head>
<body>
	<header>
		<div class="center">
			<hgroup>
				<h1>Quienlocompra.com</h1>
			</hgroup>
			<form action="#" method="get">
				<input type="text" name="search" placeholder="Buscar" />
			</form>
		</div>
	</header>
	<div class="center">
		<figure id="logo">
			<img src="img/logo.png" alt="Quienlocompra" />
		</figure>
		<div>
			<form id="login" action="#" method="get">
				<hgroup>
					<h2>Iniciar sesión</h2>
				</hgroup>
				<input type="text" name="user" placeholder="Usuario" />
				<input type="password" name="pass" placeholder="Contraseña" />
				<div>
					<label><input type="checkbox" name="keeplogin" checked /> Mantenerme conectado</label>
				</div>
				<button>Iniciar</button>
				<a href="request_password.php">?olvidaste tu contraseña¿</a>
			</form>
			<form id="register" action="apps/register.php" method="post">
				<hgroup>
					<h2>Regístrate</h2>
				</hgroup>
				<input type="text" name="user" placeholder="Nombre de usuario" />
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pass" placeholder="Contraseña" />
				<img id="captcha" src="apps/captcha.php" />
				<input type="text" name="captcha" placeholder="Captcha" maxlength="8" />
				<button>Registrarme</button>
			</form>
		</div>
	</div>
	<footer>
		<p>Quienlocompra &copy; 2012</p>
		<nav>
			<ul>
				<li><a href="#">Acerca de</a></li>
				<li><a href="#">Dannegm</a></li>
				<li><a href="#">Gomosoft</a></li>
				<li><a href="#">Desarrollo</a></li>
				<li><a href="#">Términos de uso</a></li>
			</ul>
		</nav>
	</footer>
</body>
</html>