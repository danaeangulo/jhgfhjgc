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
	<title>Daale - Rutinas</title>
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
				Rutina eliminada
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
		if ($_SESSION['Rutina']==0) {
		}else if ($_SESSION['Rutina']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Rutina']=0;
		}else if ($_SESSION['Rutina']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['Rutina']=0;
		}else if ($_SESSION['Rutina']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Rutina']=0;
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
	<header>
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Rutinas</h2>
			<a id="boton-derecha" href="agregar-rutina.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<div class="fila1">


				<div class="text-left">
					Las rutinas agregadas no podrán ser vistas ni utilizadas por otros instructores.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">
			</div>
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Rutinas) FROM rutinas WHERE ID_Instructor='$id_instructor'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$r=$fila0[0];
			}
			if ($r!=0) {
			 ?>
			<table class="tabla">
				<tr>
				 	<th>Nombre</th>
					<th>Tiempo(min)</th>
					<th class="desaparece">Cuerpo</th>
					<th class="desaparece">Sexo</th>
					<th class="desaparece">Objetivo</th>
					<th>Series</th>
					<th class="text-eliminar">Editar</th>
					<th class="text-eliminar">Eliminar</th>
				</tr>
				<?php
					$query2 = "SELECT R.ID_Rutinas, R.Nombre AS NR, R.Descripcion, R.Meta, R.Sexo, R.Tiempo_Descanso, R.Tiempo_Total, C.Nombre AS NC FROM rutinas R  INNER JOIN cuerpos C WHERE R.ID_Instructor='$id_instructor' AND C.ID_Cuerpos=R.Cuerpo";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){
					$rutina=$row2['ID_Rutinas'];
				?>
				 <tr>
			    <td><?php echo $row2['NR'] ?></td>
			    <td>
						Total: <?php echo $row2['Tiempo_Total'] ?><br/><br/>
						Descanso:<br/><?php echo $row2['Tiempo_Descanso'] ?>
					</td>
					<td  class="desaparece"><?php echo $row2['NC'] ?></td>
					<td  class="desaparece" style="padding-left:15px;"><?php echo $row2['Sexo'] ?></td>
					<td  class="desaparece" style="padding-left:15px;">
						<?php $res=$row2['Meta'];
							if($res==1){
						?>
								<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
						<?php
							}else{
						?>
								<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
						<?php
							}
						?>
					</td>
					<td><?php
					$query3=("SELECT S.Nombre FROM conjuntos C INNER JOIN series S WHERE S.ID_Instructor='$id_instructor' AND  C.ID_Rutinas='$rutina'  AND C.ID_Series=S.ID_Series");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					echo $row3['Nombre'];
					?>,
					<?php
					}?>
					</td>
					<td class="cambiar"> <a href="editar-rutina.php?id=<?php echo $row2['ID_Rutinas']; ?>"><span class="fa fa-pencil"></span></a></td>
					<td class="eliminar"> <a href="../../php/instructor/eliminar-rutina.php?id=<?php echo $row2['ID_Rutinas']; ?>"><span class="fa fa-trash"></span></a></td>
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
