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
	<title>Daale - Recetas</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/ejercicios.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
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
				Receta eliminada
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
		if ($_SESSION['Receta']==0) {
		}else if ($_SESSION['Receta']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Receta']=0;
		}else if ($_SESSION['Receta']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Receta']=0;
		}else if ($_SESSION['Receta']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Receta']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN nutriologo I ON I.User=U.ID_User  WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_nutriologo=$row['ID_Nutriologo'];
		$validado=$row['Validado'];
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Recetas</h2>
			<a id="boton-derecha" href="agregar-receta.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<div class="fila1">

				<div class="text-left">
					Las recetas agregadas no podrán ser vistas ni utilizadas por otros nutriólogos.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">
			</div>
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Recetas) FROM recetas WHERE ID_Nutriologo='$id_nutriologo'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$r=$fila0[0];
			}
			if ($r!=0) {
			 ?>
			<table class="tabla">
			  <tr>
					<th>Imagen</th>
			    <th>Nombre</th>
			    <th class="desaparece">Tiempo</th>
					<th>Calorias</th>
					<th class="desaparece">Ingredientes</th>
					<th class="text-eliminar">Editar</th>
					<th class="text-eliminar">Eliminar</th>
			  </tr>

				<?php
					$query2 = "SELECT R.ID_Recetas, R.Foto_Receta, R.Nombre AS N, R.Tiempo_P, R.Calorias FROM recetas R  WHERE R.ID_Nutriologo='$id_nutriologo'";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){
					$receta=$row2['ID_Recetas'];
				?>
			  <tr>
						<td>
						 <img style="width:100px; padding:0; margin:0;"src="data:image/jpg;base64, <?php echo base64_encode($row2['Foto_Receta'])?>" alt="">
						</td>
						<td><?php echo $row2['N']; ?></td>
				    <td class="desaparece"><?php echo $row2['Tiempo_P']; ?></td>
						<td><?php echo $row2['Calorias']; ?></td>
			    	<td class="desaparece">
							<?php
							$query3=("SELECT A.Nombre FROM conjuntoa C INNER JOIN alimentos A WHERE A.ID_Nutriologo='$id_nutriologo' AND  C.ID_Recetas='$receta'  AND C.ID_Alimentos=A.ID_Alimentos");
							$resultado3 = $conexion->query($query3);
							while($row3 = $resultado3->fetch_assoc()){
							echo $row3['Nombre'];
							?>,
							<?php
						}?>
						</td>
					<td class="cambiar"> <a href="editar-receta.php?id=<?php echo $row2['ID_Recetas']; ?>"><span class="fa fa-pencil"></span></a></td>
					<td class="eliminar"> <a href="../../php/nutriologo/eliminar-receta.php?id=<?php echo $row2['ID_Recetas']; ?>"><span class="fa fa-trash"></span></a></td>
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
