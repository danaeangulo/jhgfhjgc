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
		$query = "SELECT * FROM instructor I INNER JOIN user U ON I.User= U.ID_User WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	</div>
	<header>
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Contacto</h2>
			<div class="line"></div>
			<div class="fila1">

<form action="../../php/instructor/enviar-contacto.php" method="post">
		<h2>¿Tienes alguna pregunta?</h2>
		<div class="text-left">Envía un e-mail directamente rellenando el siguiente formulario.  </div>
		<div class="text-left1">Nombre</div>
		<div class="text-left2">Nombre de usuario</div>
		<div class="text-left2">Teléfono</div>
		<input class="medio1" type="text" name="nombre" value="<?php echo $row['Nombre'];?>&nbsp;<?php echo $row['Ap_P']; ?>&nbsp;<?php echo $row['Ap_M']; ?>&nbsp;<?php echo $row['Validado']; ?>" readonly>
		<input class="medio2" type="text" name="user" value="<?php echo $row['User']; ?>" readonly>
		<input class="medio3" type="text" name="telefono" value="<?php echo $row['Telefono']; ?>"  readonly>
		<div class="text-left">Correo</div>
  	<input  type="text" name="correo" value="<?php echo $row['Correo']; ?>"  readonly>
  	<div class="text-left">Mensaje</div>
  	<textarea name="mensaje"  required></textarea>
		<input type="submit" value="Enviar" id="boton">
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
