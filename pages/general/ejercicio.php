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
	<title>Daale - Ejercicio</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/peso.css">
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
		$query = "SELECT * FROM general G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_general=$row['ID_General'];
		$rutina=$row['Rutina'];
		if ($rutina==0) {
			header("Location:seleccionar-rutina.php");
		}
	 ?>
	</div>
	<header>
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Ejercicio</h2>
			<div class="line"></div>
			<div class="fila1">

				<div class="text-left">
					Ingresa directamente desde nuestra aplicación móvil para iniciar con tu rutina.
				</div>
				<div class="text-left"><a href="informacion-aplicacion.php">Más información.</a></div>

			</div>
			<div class="fila1">

			<table>
			  <tr>
			    <th class="arriba-izq">Fecha</th>
					<th>Situacion</th>
			  </tr>
				<?php
					$query2 = "SELECT E.Fecha, E.Situacion FROM ejercicio E INNER JOIN rutinas R WHERE E.ID_General='$id_general' AND R.ID_Rutinas='$rutina' ORDER BY E.Fecha DESC";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){
			 	?>
			  <tr>
			    <td style="text-align:left;"><?php echo $row2['Fecha']; ?></td>
					<td><?php echo $row2['Situacion']; ?></td>
			  </tr>
			<?php } ?>

			</table>

			</div>
			<div class="fila1">
				<div class="text-left">
					¿Quieres cambiar tu rutina? Presiona el siguiente enlace para seleccionar tu mejor opción.
				</div>
				<div class="text-left"><a href="cambiar-rutina.php">Cambiar rutina.</a></div>
			</div>
		</div>

  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
