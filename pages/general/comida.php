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
	<title>Daale - Comida</title>
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
		$dieta=$row['Dieta'];
		if ($dieta==0) {
			header("Location:seleccionar-dieta.php");
		}
	 ?>
	</div>
	<header>
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Comida</h2>
			<div class="line"></div>
			<div class="fila1">

				<div class="text-left">
					Ingresa directamente desde nuestra aplicación móvil para registrar los alimentos consumidos a lo largo del día.
				</div>
				<div class="text-left"><a href="informacion-aplicacion.php">Más información.</a></div>

			</div>
			<div class="fila1">

			<table>
			  <tr>
			    <th class="arriba-izq">Fecha</th>
			    <th class="arriba-izq">Calorías consumidas</th>
			    <th class="arriba-izq">Macros</th>
					<th class="text-eliminar">Situación</th>
			  </tr>
				<?php
					$query2 = "SELECT C.Fecha, C.Calorias, C.P_Proteinas, C.P_Grasas, C.P_Carbohidratos, C.Situacion FROM comida C INNER JOIN dietas D WHERE C.ID_General='$id_general' AND D.ID_Dietas='$dieta' ORDER BY C.Fecha DESC";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){
			 	?>
			  <tr>
					<td style="text-align:left;"><?php echo $row2['Fecha']; ?></td>
					<td style="text-align:left;"><?php echo $row2['Calorias']; ?></td>
	 				 <td style="text-align:left;">Proteínas:&nbsp
	 					 <?php echo $row2['P_Proteinas']; ?>%<br>
	 					 Grasas:&nbsp
	 					 <?php echo $row2['P_Grasas']; ?>%<br>
	 					 Carbohidratos:&nbsp
	 					 <?php echo $row2['P_Carbohidratos']; ?>%<br>
	 				 </td>
					 <td class="eliminar"><?php echo $row2['Situacion']; ?></td>
			  </tr>
			<?php } ?>
			</table>

			</div>
			<div class="fila1">
				<div class="text-left">
					¿Quieres cambiar tu dieta? Presiona el siguiente enlace para seleccionar tu mejor opción.
				</div>
				<div class="text-left"><a href="cambiar-dieta.php">Cambiar dieta.</a></div>
			</div>
		</div>

  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
