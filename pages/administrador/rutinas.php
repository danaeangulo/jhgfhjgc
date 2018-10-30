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
	<title>Daale - Rutinas</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/administrador/tablas.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	</div>
	<header>
		<?php include('../../partes/header-administrador.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Rutinas</h2>
			<a id="boton-derecha" href="agregar-ejercicio.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<table class="tabla">
			  <tr>
			    <th>ID_R</th>
			    <th>Nombre</th>
					<th>T_Total</th>
					<th>T_Desc</th>
					<th>Descripcion</th>
					<th>Cuerpo</th>
					<th>Sexo</th>
					<th>Objetivo</th>


					<th>ID_I</th>
					<th>Nombre</th>
					<th>ID_User</th>
					<th>User</th>
			  </tr>
				<?php
					include("../../php/config.php");
					$query = "SELECT *, I.Nombre AS NI, R.Nombre AS NR, C.Nombre AS NC FROM rutinas R INNER JOIN instructor I INNER JOIN user U INNER JOIN cuerpos C WHERE R.ID_Instructor=I.ID_Instructor AND I.User=U.ID_User AND R.Cuerpo=C.ID_Cuerpos";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td><?php echo $row['ID_Rutinas'] ?></td>
					<td><?php echo $row['NR'] ?></td>
					<td><?php echo $row['Tiempo_Total'] ?></td>
					<td><?php echo $row['Tiempo_Descanso'] ?></td>
					<td class="descripcion"><?php echo $row['Descripcion'] ?></td>
					<td><?php echo $row['NC'] ?></td>
					<td><?php echo $row['Sexo'] ?></td>
					<td><?php echo $row['Meta'] ?></td>

	 				<td><?php echo $row['ID_Instructor'] ?></td>
	 				<td><?php echo $row['NI'] ?></td>
					<td><?php echo $row['ID_User'] ?></td>
	 				<td><?php echo $row['User'] ?></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
