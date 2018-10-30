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
	<title>Daale - Contacto</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/contacto.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G INNER JOIN user U ON G.User= U.ID_User WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Contacto</h2>
			<div class="line"></div>
			<div class="fila1">

<form action="../../php/general/enviar-contacto.php" method="post">
		<h2>¿Tienes alguna pregunta?</h2>
		<div class="text-left">Envía un e-mail directamente rellenando el siguiente formulario.  </div>
		<div class="text-left1">Nombre</div>
		<div class="text-left2">Nombre de usuario</div>
		<div class="text-left2">Teléfono</div>
		<input class="medio1" type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" readonly>
		<input class="medio2" type="text" name="user" value="<?php echo $row['User']; ?>" readonly>
		<input class="medio3" type="number" name="telefono"  required>
		<div class="text-left">Correo</div>
  	<input  type="email" name="correo"  required>
  	<div class="text-left">Mensaje</div>
  	<textarea name="mensaje"  required></textarea>
		<input type="submit" value="Enviar" name="enviar" id="boton">
</form>

				<div class="text-left">
					Contáctate con nosotros en caso de tener alguna sugerencia, duda u observación.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
