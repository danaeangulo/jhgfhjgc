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
	<title>Daale - Rutina</title>
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
				Rutina cambiada
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Rutina seleccionada
			</div>
		</div>
	</div>
	<?php
		if ($_SESSION['Rutinas']==0) {
		}else if($_SESSION['Rutinas']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Rutinas']=0;
		}else if($_SESSION['Rutinas']==2){
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Rutinas']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN general G WHERE G.User=U.ID_User AND G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_rutina=$row['Rutina'];
		if ($id_rutina==0) {
			header("Location:seleccionar-rutina.php");
		}
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Rutina</h2>
			<a id="boton-derecha" href="cambiar-rutina.php"><span class="fa fa-pencil"></span>&nbsp&nbspCambiar</a>
			<div class="line"></div>
			<div class="fila1">
			<?php
			$queryR = "SELECT I.ID_Instructor, R.Nombre AS NR, I.Nombre AS NI, I.Ap_P, I.Ap_M, I.Validado FROM rutinas R INNER JOIN instructor I WHERE R.ID_Rutinas='$id_rutina' AND I.ID_Instructor=R.ID_Instructor";
			$resultadoR = $conexion->query($queryR);
			$rowR = $resultadoR->fetch_assoc();
			$validado=$rowR['Validado'];
			 ?>
 			<h2>Rutina seleccionada:</h2>
			<div class="text-left" >
				Nombre: <?php echo $rowR['NR']; ?>
			</div>
			<div class="text-left" style="margin-bottom:50px;">
				Instructor:  <a href="perfil-instructor.php?id=<?php echo $rowR['ID_Instructor']; ?>"><?php echo $rowR['NI']; ?>&nbsp<?php echo $rowR['Ap_P']; ?>&nbsp<?php echo $rowR['Ap_M']; ?>&nbsp;
				<?php
					if ($validado==1) {
					?>
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				<?php } ?></a>
			</div>
		</div>
			<table class="tablaIzq">
				<tr>
				 	<th>Imagen</th>
					<th>Ejercicio</th>
					<th>Reps</th>
					<th>Descripción</th>
				</tr>
				<?php
				$query3=("SELECT A.ID_Series, A.Nombre FROM conjuntos C INNER JOIN series A WHERE C.ID_Rutinas='$id_rutina' AND C.ID_Series=A.ID_Series");
				$resultado3 = $conexion->query($query3);
				while($row3 = $resultado3->fetch_assoc()){
				$id_serie=$row3['ID_Series'];
				?>
					<tr style="background-color:#eee;">
						<td><?php echo $row3['Nombre']; ?></td><td></td><td></td><td></td>
					</tr>
					<?php
					$query4=("SELECT A.ID_Ejercicios, A.Foto_Ejercicio, A.Nombre, A.Reps, A.Descripcion FROM conjuntoe C INNER JOIN ejercicios A WHERE C.ID_Series='$id_serie' AND C.ID_Ejercicios=A.ID_Ejercicios");
					$resultado4 = $conexion->query($query4);
					while($row4 = $resultado4->fetch_assoc()){
					?>
						<tr>
							<td>
							 <img style="width:100px;" src="data:image/jpg;base64, <?php echo base64_encode($row4['Foto_Ejercicio'])?>" alt="">
							</td>
							<td><?php echo $row4['Nombre']; ?></td>
					    <td><?php echo $row4['Reps']; ?></td>
							<td><?php echo $row4['Descripcion']; ?></td>
						</tr>
					<?php } ?>
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
