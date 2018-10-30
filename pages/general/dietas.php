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
	<title>Daale - Dietas</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Dieta cambiada
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Dieta seleccionada
			</div>
		</div>
	</div>
	<?php
		if ($_SESSION['Dietas']==0) {
		}else if($_SESSION['Dietas']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Dietas']=0;
		}else if($_SESSION['Dietas']==2){
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Dietas']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN general G WHERE G.User=U.ID_User AND G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_dieta=$row['Dieta'];
		if ($id_dieta==0) {
			header("Location:seleccionar-dieta.php");
		}
	 ?>

	<header>
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Dieta</h2>
			<a id="boton-derecha" href="cambiar-dieta.php"><span class="fa fa-pencil"></span>&nbsp&nbspCambiar</a>
			<div class="line"></div>
				<?php
				$queryD = "SELECT N.ID_Nutriologo, D.Nombre AS ND, N.Nombre AS NN, N.Ap_P, N.Ap_M, N.Validado, D.Calorias FROM dietas D INNER JOIN nutriologo N WHERE D.ID_Dietas='$id_dieta' AND N.ID_Nutriologo=D.ID_Nutriologo";
				$resultadoD = $conexion->query($queryD);
				$rowD = $resultadoD->fetch_assoc();
				$validado=$rowD['Validado'];
				 ?>
				<h2>Dieta seleccionada:</h2>
				<div class="text-left" >
					Nombre: <?php echo $rowD['ND']; ?>
				</div>
				<div class="text-left" >
					Calorías: <?php echo $rowD['Calorias']; ?>
				</div>
				<div class="text-left" style="margin-bottom:50px;">
					Nutriólogo: <a href="perfil-nutriologo.php?id=<?php echo $rowD['ID_Nutriologo']; ?>"><?php echo $rowD['NN']; ?>&nbsp<?php echo $rowD['Ap_P']; ?>&nbsp<?php echo $rowD['Ap_M']; ?>&nbsp;
					<?php
						if ($validado==1) {
						?>
						<i class="fa fa-check-circle" aria-hidden="true"></i>
					<?php } ?></a>
				</div>


			<table class="tablaIzq">
				<tr>
				 	<th>Imagen</th>
					<th>Nombre</th>
					<th>Calorías</th>
				</tr>


					<tr style="background-color:#eee;">
						<td>Alimentos<td><td></td></td></td>
					</tr>
					<?php
					$query3=("SELECT A.Foto_Alimento, A.Nombre, A.Calorias FROM conjuntora C INNER JOIN alimentos A WHERE C.ID_Dietas='$id_dieta' AND C.ID_Alimentos=A.ID_Alimentos");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){

					?>
							<tr>
								<td>
								 <img style="width:100px;" src="data:image/jpg;base64, <?php echo base64_encode($row3['Foto_Alimento'])?>" alt="">
								</td>
								<td><?php echo $row3['Nombre']; ?></td>
								<td><?php echo $row3['Calorias']; ?></td>
							</tr>
							<?php } ?>
					<tr style="background-color:#eee;">
						<td>Recetas<td><td></td></td></td>
					</tr>
					<?php
					$query4=("SELECT A.Foto_Receta, A.Nombre, A.Calorias FROM conjuntor C INNER JOIN recetas A WHERE C.ID_Dietas='$id_dieta' AND C.ID_Recetas=A.ID_Recetas");
					$resultado4 = $conexion->query($query4);
					while($row4 = $resultado4->fetch_assoc()){
					?>
						<tr>
							<td>
							 <img style="width:100px;"src="data:image/jpg;base64, <?php echo base64_encode($row4['Foto_Receta'])?>" alt="">
							</td>
							<td><?php echo $row4['Nombre']; ?></td>
							<td><?php echo $row4['Calorias']; ?></td>
						</tr>
							<?php } ?>
			</table>

				<div class="text-left">
					Registra tu peso actual para una mayor precisión en tu desempeño.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
