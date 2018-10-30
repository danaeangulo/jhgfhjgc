<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
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
	<title>Daale - Agregar Unidad</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/administrador/editar.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Sin modificaciones
			</div>
		</div>
	</div>
	<header >
		<?php include('../../partes/header-administrador.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Unidad</h2>
			<div class="line"></div>
		<form action="" id="formulario" method="post">
				<div class="text-left">Nombre:</div>
				<input  type="text" name="nombre"  required>
				<input type="submit" value="Agregar" id="boton">
		</form>
		<script type="text/javascript">
			jQuery(document).on('submit', '#formulario', function(event){
				event.preventDefault();
				jQuery.ajax({
					url: '../../php/administrador/agregar-unidad.php',
					type: 'POST',
					dataType: 'json',
					data: $(this).serialize(),
					beforeSend: function(){
							$('.btn').val('Agregando...');
					}
				})
				.done(function(respuesta){
					console.log(respuesta);
					if (!respuesta.error1) {
						if (respuesta.var == 1) {
							location.href = 'unidades.php';
						}
					} else if (respuesta.error1 == true) {
						$('#error1').slideDown('slow');
						setTimeout(function(){
								$('#error1').slideUp('slow');
						}, 3000);
						$('.btn').val('Agregar');
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
</body>
</html>
