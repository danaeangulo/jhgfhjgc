<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==2) {
	header("Location:../administrador/general.php");
}elseif ($_SESSION['Rol']==3) {
	header("Location:../instructor/rutinas.php");
}elseif ($_SESSION['Rol']==4) {
	header("Location:../nutriologo/dietas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Editar Perfil</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
	<script type="text/javascript">
		function clave(_valor){
			document.getElementById('clave').style.visibility=_valor;
		}
	</script>
</head>
<body>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G INNER JOIN user U ON G.User= U.ID_User WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Datos guardados
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Contraseña cambiada
			</div>
		</div>
	</div>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Sin modificaciones
			</div>
		</div>
	</div>
	<div class="toast error2" id="error2">
		<div class="toast-contenido">
			<div class="text1">
				Las contraseñas no coinciden
			</div>
		</div>
	</div>
	<div class="toast error3" id="error3">
		<div class="toast-contenido">
			<div class="text1">
				Contraseña actual incorrecta
			</div>
		</div>
	</div>
	<div class="modal" id="clave">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar contraseña</div>
				<a id="close" class="close2" href="javascript:clave('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="" id="form-clave" method="post">
					<div class="text-left">Actual</div>
					<input  type="password" name="rpass_act" placeholder="Contraseña actual" required>

					<div class="text-left">Nueva</div>
					<input  type="password" name="pass" placeholder="Contraseña nueva" required>
					<div class="text-left">Verificar</div>
					<input  type="password" name="rpass" placeholder="Confirmar contraseña nueva" required>
					<div class="text-left">Asegurate de que las contraseñas coincidan y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:clave('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
			<script type="text/javascript">
				jQuery(document).on('submit', '#form-clave', function(event){
					event.preventDefault();
					jQuery.ajax({
						url: '../../php/general/editar-clave.php',
						type: 'POST',
						dataType: 'json',
						data: $(this).serialize(),
						beforeSend: function(){
								$('.btn').val('Guardando...');
						}
					})
					.done(function(respuesta){
						console.log(respuesta);
						if (!respuesta.error2 && !respuesta.error3) {
							if (respuesta.var == 1) {
								document.getElementById('clave').style.visibility="hidden";
								$('#alerta2').slideDown('slow');
								setTimeout(function(){
										$('#alerta2').slideUp('slow');
								}, 3000);
							}
						} else if (respuesta.error3 == true) {
							$('#error3').slideDown('slow');
							setTimeout(function(){
									$('#error3').slideUp('slow');
							}, 3000);
							$('.btn').val('Listo');
						}else if (respuesta.error2 == true) {
							$('#error2').slideDown('slow');
							setTimeout(function(){
									$('#error2').slideUp('slow');
							}, 3000);
							$('.btn').val('Listo');
						}
					})
					.fail(function(resp){
						console.log(resp);
					})
					.always(function(respuesta){
						console.log("complete");
					});
				});
			</script>
		</div>
	</div>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Perfil</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar la información de tu propio perfil para una mejor evaluación.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

			<form>
				<h2>Información de cuenta:</h2>
				<input class="boton-clave" onclick="clave('visible')" type="button" value="Cambiar contraseña">
			</form>

		<form action="" id="formulario" method="post">
				<div class="text-left">Nombre de usuario</div>
				<input  type="text" name="user" value="<?php echo $row['User']; ?>" required>

				<h2>Información de perfil:</h2>
				<div class="text-left">Nombre</div>
				<input  type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" required>

				<div class="text-left">Fecha de nacimiento</div>
				<input type="date" name="fecha" value="<?php echo $row['Fech_Nac']; ?>" required>

				<div class="text-left1">Altura</div>
				<div class="text-left2">Peso Actual</div>
				<div class="text-left2">Peso Meta</div>
				<input class="medio1" type="number" name="altura" value="<?php echo $row['Altura']; ?>" required>
				<input class="medio2" type="number" name="peso_act" value="<?php echo $row['Peso_Act']; ?>" readonly>
				<input class="medio3" type="number" name="peso_meta" value="<?php echo $row['Peso_Meta']; ?>" required>

				<input type="submit" value="Editar" id="boton" id="btn">
				<div class="text-left">Modifica la información de tu perfil y presiona el botón editar.  </div>
		</form>

		<script type="text/javascript">
			jQuery(document).on('submit', '#formulario', function(event){
				event.preventDefault();
				jQuery.ajax({
					url: '../../php/general/editar-perfil.php',
					type: 'POST',
					dataType: 'json',
					data: $(this).serialize(),
					beforeSend: function(){
							$('.btn').val('Guardando...');
					}
				})
				.done(function(respuesta){
					console.log(respuesta);
					if (!respuesta.error1) {
						if (respuesta.var == 1) {
							location.href = 'perfil.php';
							$('#alerta1').slideDown('slow');
							setTimeout(function(){
									$('#alerta1').slideUp('slow');
							}, 3000);
						}
					} else if (respuesta.error1 == true) {
						$('#error1').slideDown('slow');
						setTimeout(function(){
								$('#error1').slideUp('slow');
						}, 3000);
						$('.btn').val('Editar');
					}
				})
				.fail(function(resp){
					console.log(resp);
				})
				.always(function(respuesta){
					console.log("complete");
				});
			});
		</script>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
