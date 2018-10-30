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
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Ejercicios</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/ejercicios.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Datos guardados
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Ejercicio eliminado
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
		if ($_SESSION['Ejercicio']==0) {
		}else if ($_SESSION['Ejercicio']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Ejercicio']=0;
		}else if ($_SESSION['Ejercicio']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['Ejercicio']=0;
		}else if ($_SESSION['Ejercicio']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Ejercicio']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN instructor I ON I.User=U.ID_User  WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_instructor=$row['ID_Instructor'];
		$validado=$row['Validado'];
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Ejercicios</h2>
			<a id="boton-derecha" href="agregar-ejercicio.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<div class="fila1">


				<div class="text-left">
					Los ejercicios agregados no podrán ser vistos ni utilizados por otros instructores.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Ejercicios) FROM ejercicios WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}
				if ($r!=0) {
				 ?>
			</div>

			<table class="tabla">
			  <tr>
			    <th>Imagen</th>
			    <th>Nombre</th>
			    <th>Rep(s)</th>
					<th class="descripcion">Descripción</th>
					<th class="text-eliminar">Editar</th>
					<th class="text-eliminar">Eliminar</th>
			  </tr>
				<?php
					$query2 = "SELECT * FROM ejercicios WHERE ID_Instructor='$id_instructor' AND Reps is not NULL";
					$resultado2 = $conexion->query($query2);
					while($row = $resultado2->fetch_assoc()){
			 	?>
			  <tr>
					<td>
					 <img style="width:100px; padding:0; margin:0;"style="width:60%;"src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Ejercicio'])?>" alt="">
				 	</td>
					<td><?php echo $row['Nombre']; ?></td>
					<td><?php echo $row['Reps']; ?></td>
			    <td class="descripcion"><?php echo $row['Descripcion']; ?></td>
					<td class="cambiar"> <a href="editar-ejercicio.php?id=<?php echo $row['ID_Ejercicios']; ?>"><span class="fa fa-pencil"></span></a></td>
					<td class="eliminar"> <a href="../../php/instructor/eliminar-ejercicio.php?id=<?php echo $row['ID_Ejercicios']; ?>"><span class="fa fa-trash"></span></a></td>
			  </tr>
			<?php } ?>

			</table>
		<?php } ?>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
