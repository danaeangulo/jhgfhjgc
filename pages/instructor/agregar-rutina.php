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
	<title>Daale - Agregar rutina</title>
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
	 ?>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Rutina</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás agregar tus rutinas, posteriormente editarlas y manipularlas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/instructor/agregar-rutina.php?id=<?php echo $row['ID_Instructor']; ?>" method="post">
				<h2>Rellenado de formulario:</h2>
				<input  class="pequeño" type="text" name="nombre" placeholder="Nombre de la rutina" required>

				<div class="text-izq">60min recomendado</div>
				<div class="text-der">1min recomendado</div>
				<input class="pequeño1" type="number" name="total" placeholder="Tiempo total (min)" required>
				<input class="pequeño2" type="number" name="descanso" placeholder="Tiempo de descanso entre ejercicios (min)" required>
				<textarea name="descripcion" placeholder="Descripción de la rutina" required></textarea>

				<h2>¿Hacia quién va dirigida?</h2>
				<div class="text-left1">Tipo de cuerpo</div>
				<div class="text-left2">Objetivo de peso</div>
				<div class="text-left2">Sexo</div>
				<select name="cuerpo" class="medio1">
					<option value="1" required>Hectomorfo</option>
					<option value="2">Mesomorfo</option>
					<option value="3">Endomorfo</option>
				</select>
				<select name="meta" class="medio2">
					<option value="1" required>Aumentar</option>
					<option value="0">Bajar</option>
				</select>
				<select name="sexo" class="medio3">
					<option value="H" required>Hombre</option>
					<option value="M">Mujer</option>
				</select>
				<input type="submit" value="Agregar" id="boton">
				<div class="text-left">Completa todo el formulario correctamente y presiona agregar.  </div>
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
