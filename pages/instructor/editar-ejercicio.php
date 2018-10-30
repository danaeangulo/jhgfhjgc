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
	<title>Daale - Editar ejercicio</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
	<script type="text/javascript">
		function desplegar(_valor){
			document.getElementById('foto-ejercicio').style.visibility=_valor;
		}
	</script>
</head>
<body>
	<?php
			include("../../php/config.php");
			$user=$_SESSION['ID_User'];
			$id=$_REQUEST['id'];
			$query = "SELECT E.Nombre AS NE, E.Reps, E.Descripcion FROM ejercicios E INNER JOIN instructor I ON E.ID_Instructor=I.ID_Instructor WHERE E.ID_Ejercicios='$id'";
			$resultado = $conexion->query($query);
			while($row = $resultado->fetch_assoc()){

	 ?>
	 <div class="modal" id="foto-ejercicio">
 		<div class="modal-contenido">
 			<div class="arriba-editar"><!--modificar-->
 				<div class="izq-titulo">Editar foto del ejercicio</div>
 				<a id="close" class="close2" href="javascript:desplegar('hidden');"><span class="fa fa-times"></span></a>
 				<div class="line-titulo"></div>
 			</div>
 			<form action="../../php/instructor/cambiar-foto-ejercicio.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
 					<div class="text-left">Seleccionar foto del ejercicio</div>
 					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

 					<div class="text-left">Modifica la foto de tu ejercicio y presiona listo para guardar los cambios.  </div>
 					<div class="abajo-botones">
 						<input type="submit" value="Listo" id="boton-listo">
 						<div id="close" class="cancelar">
 							<a  href="javascript:desplegar('hidden');">Cancelar</a>
 						</div>
 					</div>
 			</form>
 		</div>
 	</div>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Ejercicio</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus ejercicios.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/instructor/editar-ejercicio.php?id=<?php echo $id; ?>" method="post">
				<h2>Rellenado de formulario:</h2>
				<div class="text-left3">Nombre del ejercicio</div>
				<div class="text-left4">Repeticiones (Rep's)</div>
				<input  class="pequeño1" type="text" name="nombre" value="<?php echo $row['NE'] ?>" required>
				<input class="pequeño2" type="number" name="reps" value="<?php echo $row['Reps'] ?>" required>


				<input class="boton-clave" onclick="desplegar('visible')" type="button" name="foto-ejercicio" value="Cambiar foto del ejercicio">

				<div class="text-left">Descripción</div>
				<textarea name="descripcion" required><?php echo $row['Descripcion'] ?></textarea>

				<div class="text-left">Modifica la información de tu perfil y presiona el botón editar.  </div>
				<input type="submit" value="Editar" id="boton">
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
