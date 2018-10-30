<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
}elseif ($_SESSION['Rol']==2) {
	header("Location:../administrador/general.php");
}elseif ($_SESSION['Rol']==4) {
	header("Location:../nutriologo/dietas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Configuración</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script type="text/javascript">
	function nombre(_valor){
		document.getElementById('nombre').style.visibility=_valor;
	}
	function abre(_valor){
		document.getElementById('nombre').style.visibility=_valor;
		document.getElementById('uno').style.display="block";
		document.getElementById('dos').style.display="none";
	}
	function mostrar(){
		document.getElementById('uno').style.display="none";
		document.getElementById('dos').style.display="block";
	}
	</script>
</head>
<body>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Contraseña incorrecta
			</div>
		</div>
	</div>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM instructor G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Configuración</h2>
			<div class="line"></div>
			<div class="text-center">
				<h4 style="margin-bottom:10px;">Lo sentimos <span class="fa fa-frown-o"></span></h4>
				Aún no hay elementos a configurar.
			</div>
			<!--
			<div class="fila1">
				<h4 style="margin-bottom:10px;">Cuenta</h4>
				<div class="text-center">
					Al eliminar tu cuenta perderás todos los datos y registros guardados a
				</div>
				<div class="text-center">
					largo de tu estancia en Daale y tu nombre usuario quedará libre y limpio.
				</div>
				<div class="boton-eliminar3" style="margin-top: 30px;">
					<a id="boton-abajo" onclick="javascript:abre('visible');"><span class="fa fa-exclamation-triangle"></span>&nbsp&nbspEliminar</a>
				</div>

			</div>
-->
		</div>
  </section>
	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Eliminar</div>
				<a id="close" class="close2" href="javascript:nombre('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<div id="uno">
				<script type="text/javascript">


				</script>
					<div class="text-left" style="font-size:14px;">Por seguridad, ingresa tu contraseña para continuar:</div>
					<form id="form-clave" action="" method="post">
						<div class="abajo-botones">
							<input type="password" name="rpass_act" placeholder="Contraseña actual">
							<input type="submit" id="boton-continuar" name="" value="Continuar">

							<div id="close" class="cancelar">
								<a  href="javascript:nombre('hidden');">Cancelar</a>
							</div>
						</div>
					</form>
					<script type="text/javascript">
						jQuery(document).on('submit', '#form-clave', function(event){
							event.preventDefault();
							jQuery.ajax({
								url: '../../php/general/comprobar-clave.php',
								type: 'POST',
								dataType: 'json',
								data: $(this).serialize(),
								beforeSend: function(){
										$('.btn').val('Comprobado...');
								}
							})
							.done(function(respuesta){
								console.log(respuesta);
								if (!respuesta.error2) {
									if (respuesta.var == 1) {
										document.getElementById('uno').style.display="none";
										document.getElementById('dos').style.display="block";
									}
								} else if (respuesta.error2 == true) {
									$('#error1').slideDown('slow');
									setTimeout(function(){
											$('#error1').slideUp('slow');
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
			<div id="dos" class="dos">
					<div class="text-left" style="font-size:14px;">¿Estás seguro de eliminar tu cuenta?  </div>
					<div class="abajo-botones">
						<a href="../../php/general/eliminar-cuenta.php" id="boton-eliminar">Eliminar</a>

						<div id="close" class="cancelar">
							<a  href="javascript:nombre('hidden');">Cancelar</a>
						</div>
					</div>
			</div>
		</div>
	</div>
	<?php include('../../partes/footer.php'); ?>

<?php } ?>
</body>
</html>
