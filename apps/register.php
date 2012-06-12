<?php
session_start();
$doreg = isset($_SESSION['doreg']) ? $_SESSION['doreg'] : 'off';
if ( $doreg == 'on' ):
?>
<!DOCTYPE html>
<html lang="es-Mx">
<head>
	<meta charset="UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="../css/default.css" />
	<link rel="stylesheet" href="../css/custom-theme/jquery-ui.css" />
	<title>Registro - Quienlocompra.com</title>

	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script>
		jQuery(function() {
			var now = 1;
			$('.donext').click(function(e){
				e.preventDefault();
				$('#step' + now).removeClass('now').addClass('back');
				$('#step' + (now +1)).removeClass('next').addClass('now');
				++now;
			});
			$('.doback').click(function(e){
				e.preventDefault();
				$('#step' + now).removeClass('now').addClass('next');
				$('#step' + (now -1)).removeClass('back').addClass('now');
				--now;
			});

			$('[name="birddate"]').datepicker({
				dateFormat: 'D d MM, yy',
				changeMonth: true,
				changeYear: true,
				dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				dayNamesShort: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
					'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr',
					'May', 'Jun', 'Jul', 'Ago',
					'Sep', 'Oct', 'Nov', 'Dic']
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
	<form action="regcomplete.php" method="post" class="center">
		<input type="hidden" name="do" value="it" />

		<section id="step1" class="medium top50 now">
			<hgroup>
				<h1>Completa el registro</h1>
			</hgroup>
			<div>
				<hgroup>
					<h2>Paso 1 <span>Términos de uso</span></h2>
				</hgroup>
				<div>
					<p class="large">
						Antes que cualquier cosa pase, es múy importante que leas detenidamente el siguiente contrato, ya que te avalará como usuario, cliente y/o vendedor durante tu estadía en Quienlocompra.
					</p>
				</div>
			</div>
			<footer>
				<a class="donext button red" href="#">Aceptar y continuar</a>
				<a class="button" href="../">Rechazar y borrar mis datos</a>
			</footer>
		</section>

		<section id="step2" class="medium next">
			<hgroup>
				<h1>Completa el registro</h1>
			</hgroup>
			<div>
				<hgroup>
					<h2>Paso 2 <span>Datos personales</span></h2>
				</hgroup>
				<div>
					<p class="medium">
						Necesitamos saber más acerca de ti, tu nombre, tu edad, tu dirección. Todo esto con el fin de protegerte y proteger a los demás usuarios con los que probablemente tendrás contacto.
					<br /><br />
						Si te preocupa tu privacidad, podrías revisar más a detalle nuestras <a href="#">políticas de privacidad</a>.
					<br /><br />
						Todos los datos son requeridos.
					</p>
					<fieldset>
						<div>
							<label>Nombre completo</label>
							<input type="text" name="name" />
						</div>
						<div>
							<label>Fecha de nacimiento</label>
							<input type="text" name="birddate" />
							<div id="calendar"></div>
						</div>
						<div>
							<div class="c2">
								<label>Sexo</label>
								<select name="gen">
									<option value="h">Hombre</option>
									<option value="m">Mujer</option>
								</select>
							</div>
							<div class="c2">
								<label>País</label>
								<select name="country">
									<option value="mx">México</option>
									<option value="co">Colombia</option>
								</select>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<footer>
				<a class="donext button red" href="#">Continuar</a>
				<a class="doback button" href="#">Regresar</a>
			</footer>
		</section>

		<section id="step3" class="medium next">
			<hgroup>
				<h1>Completa el registro</h1>
			</hgroup>
			<div>
				<hgroup>
					<h2>Paso 3 <span>Tipo de usuario</span></h2>
				</hgroup>
				<div>
					<p class="medium">
						Para poder participar en Quienlocompra, necesitamos definirte como usuario, tal vez solo quieras comprar, o tal vez tienes un pequeño negocio que necesite vender por internet o tal vez eres el representante de una gran compañía.
					<br /><br />
						Por favor selecciona el tipo de usuario que eres y rellena todos los campos.
					</p>
					<fieldset>
						<div>
							<label>Tipo de usuario</label>
							<select name="type" class="w200">
								<option value="normal">Usuario</option>
								<option value="costumer">Comprador</option>
								<option value="seller">Vendedor</option>
								<option value="bussines">Negocio</option>
								<option value="company">Compañia</option>
							</select>
						</div>
					</fieldset>
				</div>
			</div>
			<footer>
				<a class="donext button red" href="#">Continuar</a>
				<a class="doback button" href="#">Regresar</a>
			</footer>
		</section>

		<section id="step4" class="medium next">
			<hgroup>
				<h1>Completa el registro</h1>
			</hgroup>
			<div>
				<hgroup>
					<h2>Paso 4 <span>Foto de perfil</span></h2>
				</hgroup>
				<div>
					<p class="medium">
						Para tener más confianza entre los usuarios es recomendable establecer una foto de perfil, ya sea una foto personal o un logotipo de tu compañía; esto con el fin de poder identificarte visualmente.
					<br /><br />
						Así que elije una foto donde salgas bien peinado.
					</p>
					<iframe src="uploader.php">
					</iframe>
				</div>
			</div>
			<footer>
				<a class="donext button red" href="#">Continuar</a>
				<a class="doback button" href="#">Regresar</a>
			</footer>
		</section>

		<section id="step5" class="medium next">
			<hgroup>
				<h1>Completa el registro</h1>
			</hgroup>
			<div>
				<hgroup>
					<h2>Paso 5 <span>Invita gente</span></h2>
				</hgroup>
				<div>
					<p class="medium">
						Has crecer esto junto con nosotros, invita gente y descubran todo lo que podrán hacer en Quienlocompra.
					<br /><br />
						No te guardes el secreto, grítalo a todo el mundo.
					</p>
				</div>
			</div>
			<footer>
				<button class="red">Finalizar</button>
				<a class="doback button" href="#">Regresar</a>
			</footer>
		</section>

	</form>
	<footer class="fixed">
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
<?php
else:
	header('Location: ../');
endif;
?>