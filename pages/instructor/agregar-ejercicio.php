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
	<title>Daale - Agregar ejercicio</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
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
		$query = "SELECT * FROM instructor I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$validado=$row['Validado'];
	 ?>
	<header>
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Ejercicio</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás agregar tus ejercicios, posteriormente editarlos y manipularlos.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/instructor/agregar-ejercicio.php?id=<?php echo $row['ID_Instructor']; ?>" method="post" enctype="multipart/form-data">
				<h2>Rellenado de formulario:</h2>
				<input  class="pequeño1" type="text" name="nombre" placeholder="Nombre del ejercicio" required>
				<input class="pequeño2" type="number" name="reps" placeholder="Repeticiones (Rep's)" required>

				<div class="text-left">Foto referente al ejericio</div>
				<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" >
				<div class="text-left">Descripción:  </div>
				<textarea name="descripcion" placeholder="Descripción del ejercicio" required></textarea>

				<div class="text-left">Modifica la información de tu perfil y presiona el botón editar.  </div>
				<input type="submit" value="Agregar" id="boton">

		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
