<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
}elseif ($_SESSION['Rol']==2) {
	header("Location:../administrador/general.php");
}elseif ($_SESSION['Rol']==3) {
	header("Location:../instructor/rutinas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Agregar receta</title>
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
		$query = "SELECT * FROM nutriologo I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	<header>
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Receta</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás agregar tus recetas, posteriormente editarlas y manipularlas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/nutriologo/agregar-receta.php?id=<?php echo $row['ID_Nutriologo']; ?>" method="post"  enctype="multipart/form-data">

				<h2>Rellenado de formulario:</h2>
				<input  class="pequeño1" type="text" name="nombre" placeholder="Nombre de la receta" required>
				<input class="pequeño2" type="number" name="tiempo" placeholder="Tiempo de preparación (min)" required>

				<div class="text-left">Foto referente a la receta:</div>
				<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" >

				<div class="text-left">Descripción:</div>
				<textarea name="descripcion" placeholder="Descripción de la receta" required></textarea>

				<div class="text-left">Pasos:</div>
				<textarea name="pasos" placeholder="Modo de preparación" required>1. </textarea>

				<div class="text-left">Consejo:</div>
				<textarea name="consejo" placeholder="Consejo o nota opcional"></textarea>

					<input type="submit" value="Continuar" id="boton" >
					<div class="text-left">Presiona continuar para posteriormente agregar alimentos a tu receta.  </div>

		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
