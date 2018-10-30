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
	<title>Daale - Editar alimento</title>
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
			$query = "SELECT E.Nombre AS NE, Calorias, Cantidad, P_Proteinas, P_Grasas, P_Carbohidratos, Unidad FROM alimentos E INNER JOIN nutriologo I ON E.ID_Nutriologo=I.ID_Nutriologo WHERE E.ID_Alimentos='$id'";
			$resultado = $conexion->query($query);
			while($row = $resultado->fetch_assoc()){

	 ?>
	 <div class="modal" id="foto-ejercicio">
 		<div class="modal-contenido">
 			<div class="arriba-editar"><!--modificar-->
 				<div class="izq-titulo">Editar foto del alimento</div>
 				<a id="close" class="close2" href="javascript:desplegar('hidden');"><span class="fa fa-times"></span></a>
 				<div class="line-titulo"></div>
 			</div>
 			<form action="../../php/nutriologo/cambiar-foto-alimento.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
 					<div class="text-left">Seleccionar foto del alimento</div>
 					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

 					<div class="text-left">Modifica la foto de tu alimento y presiona listo para guardar los cambios.  </div>
 					<div class="abajo-botones">
 						<input type="submit" value="Listo" id="boton-listo">
 						<div id="close" class="cancelar">
 							<a  href="javascript:desplegar('hidden');">Cancelar</a>
 						</div>
 					</div>
 			</form>
 		</div>
 	</div>
	<header>
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Alimento</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus alimentos.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/nutriologo/editar-alimento.php?id=<?php echo $id; ?>" method="post">
				<h2>Rellenado de formulario:</h2>
				<div class="text-left3">Nombre del alimento</div>
				<div class="text-left4">Calorías</div>
				<input  class="pequeño1" type="text" name="nombre" value="<?php echo $row['NE'] ?>" required>
				<input class="pequeño2" type="number" name="calorias" value="<?php echo $row['Calorias'] ?>" required>


				<input class="boton-clave" onclick="desplegar('visible');" type="button" name="foto-alimento" value="Cambiar foto del alimento">

				<br>
				<div class="text-left-mini">Cantidad:  </div>
				<div class="text-left-mini">Unidad:  </div>

				<br>

				<input class="mini" type="float" name="cantidad" value="<?php echo $row['Cantidad'] ?>" required>
				<select name="unidad" class="mini2">
					<?php
						$id_unidades=$row['Unidad'];
						$query5 = "SELECT ID_Unidades, Nombre AS NU FROM unidades WHERE ID_Unidades='$id_unidades'";
						$resultado5 = $conexion->query($query5);
					?>
					<?php while($row5 = $resultado5->fetch_assoc()){ ?>
					<option value="<?php echo $row['Unidad']; ?>" require><?php echo $row5['NU']; ?></option>
					<?php } ?>
					<?php

						$query5 = "SELECT ID_Unidades, Nombre AS NU FROM unidades WHERE ID_Unidades<>'$id_unidades'";
						$resultado5 = $conexion->query($query5);
					?>
					<?php while($row5 = $resultado5->fetch_assoc()){ ?>
					<option value="<?php echo $row5['ID_Unidades']; ?>" require><?php echo $row5['NU']; ?></option>
					<?php } ?>

				</select>

				<br><br><br><br>

				<div class="text-left-mini">Proteínas (%):  </div>
				<div class="text-left-mini">Grasas (%):  </div>
				<div class="text-left-mini">Carbohidratos(%):  </div>

				<br>
				<input class="mini" type="number" name="proteinas" value="<?php echo $row['P_Proteinas'] ?>" required>
				<input class="mini" type="number" name="grasas" value="<?php echo $row['P_Grasas'] ?>" required>
				<input class="mini" type="number" name="carbohidratos" value="<?php echo $row['P_Carbohidratos'] ?>" required>

				<br><br><br><br>


				<input type="submit" value="Editar" id="boton">
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
