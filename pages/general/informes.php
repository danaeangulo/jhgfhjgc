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
	<title>Daale - Informes por día</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/informes.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/subheader-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<?php
		include("../../php/config.php");
		require("../../php/connect_db.php");
		date_default_timezone_set('America/Monterrey');
		$fecha=	date("Y-m-d");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_g=$row['ID_General'];
		$dieta=$row['Dieta'];
		if ($dieta==0) {
			header("Location:seleccionar-dieta.php");
		}
	 ?>
	</div>
	<header>
		<?php include('../../partes/header-general-dia.php'); ?>
	</header>

	<div class="modal" id="dia">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar fecha</div>
				<a id="close" class="close2" href="../../php/regresar.php"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="buscar-informes.php" method="post">
					<div class="text-left">Fecha</div>
					<select name="fecha">
						<?php
						$query2 = "SELECT * FROM comida C WHERE C.ID_General='$id_g' ORDER BY C.Fecha DESC";
						$resultado2 = $conexion->query($query2);
						while($row2 = $resultado2->fetch_assoc()){
						 ?>
						<option value="<?php echo $row2['Fecha']; ?>" require><?php echo $row2['Fecha']; ?></option>
					<?php } ?>
					</select>

					<div class="text-left">Modifica el día dentro del rango de 1 al 200.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="../../php/regresar.php">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>

  <section>
		<div style="margin-top:150px" class="caja animated fadeInUp">
			<h2 >Informes al día</h2>
			<div class="line"></div>
			<div class="fila1">


				<div class="text-left">
					En esta sección se mostrará el porcentaje de macros consumidos durante el día para verificar el buen funcionamiento de los alimentos consumidos de la dieta seleccionada.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">

				<h2>Fecha:</h2>
			</div>

				<form action="buscar-informes.php" method="post" style="margin-bottom:30px;">


						<select name="fecha" style="width:49%; margin-right:2%; float:left; height: 40px;">
							<?php
							$query2 = "SELECT * FROM comida C WHERE C.ID_General='$id_g' ORDER BY C.Fecha DESC";
							$resultado2 = $conexion->query($query2);
							while($row2 = $resultado2->fetch_assoc()){
							 ?>
							<option value="<?php echo $row2['Fecha']; ?>" require><?php echo $row2['Fecha']; ?></option>
						<?php } ?>
						</select>
					<input type="submit" value="Ver" id="boton-ver">
				</form>


			<h2>Por día:</h2>

			<table>
				<?php
				$query4 = "SELECT * FROM comida C WHERE C.ID_General='$id_g' AND C.Fecha='$fecha'";
				$resultado4 = $conexion->query($query4);
				$row4 = $resultado4->fetch_assoc();
				 ?>
			  <tr>
			    <th>Fecha</th>
					<td><?php echo $row4['Fecha'];?></td>
				</tr>
				<tr>
			    <th>Proteína (%)</th>
					<td><?php echo $row4['P_Proteinas']; ?>%</td>
				</tr>
				<tr>
					<th>Carbohidratos (%)</th>
					<td><?php echo $row4['P_Carbohidratos']; ?>%</td>
				</tr>
				<tr>
					<th>Grasas (%)</th>
					<td><?php echo $row4['P_Grasas']; ?>%</td>
				</tr>
				<tr>
					<th>Total macros (%)</th>
					<td><?php
						$total= $row4['P_Proteinas']+$row4['P_Carbohidratos']+$row4['P_Grasas'];
						echo $total;
					 ?>%</td>
				</tr>
				<tr>
			    <th>Calorías del día</th>
					<td><?php echo $row4['Calorias'] ?></td>
				</tr>



			</table>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
