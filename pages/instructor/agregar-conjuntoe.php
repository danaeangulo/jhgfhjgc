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
	<title>Daale - Selección ejercicios</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Ejercicio agregado
			</div>
		</div>
	</div>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Sin modificaciones
			</div>
		</div>
	</div>
	<?php
		if ($_SESSION['ConjuntoE']==0) {
		}else if ($_SESSION['ConjuntoE']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['ConjuntoE']=0;
		}else if ($_SESSION['ConjuntoE']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['ConjuntoE']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$id_s=$_REQUEST['id'];
		$query = "SELECT * FROM instructor I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_i=$row['ID_Instructor'];

	 ?>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section style="padding-bottom:100px;">
		<div class="caja animated fadeInUp"  >
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Ejercicios) FROM conjuntoe WHERE ID_Series='$id_s'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$c=$fila0[0];
			}
			if ($c==0) {
				?><h2>Agrega un ejercicio a tu serie</h2><?php
			}else{
				?><h2>Agrega otro ejercicio a tu serie</h2><?php
			}
			?>
			<div class="line"></div>
		<form action="../../php/instructor/agregar-conjuntoe.php?id=<?php echo $id_s; ?>" method="post">
				<div class="text-left">Ejercicio</div>
				<select name="ejercicio" required>
					<?php

						$query2 = "SELECT * FROM ejercicios WHERE ID_Instructor='$id_i'";
						$resultado2 = $conexion->query($query2);
					 	while($row2 = $resultado2->fetch_assoc()){
					?>
					<option value="<?php echo $row2['ID_Ejercicios']; ?>" require><?php echo $row2['Nombre']; ?></option>
				<?php } ?>
				</select>
				<div class="abajo-botones">
					<div class="cancelar2" style="width:auto;">
					<a  href="series.php">Finalizar serie</a>
					</div>
					<input type="submit" value="Agregar ejercicio" id="boton" style="width:auto; margin-right:10px; margin-left:5px;">

				</div>

				<div class="text-left" style="text-align:justify;">
					Aquí podrás agregar los ejercicios que has creado anteriormente.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
