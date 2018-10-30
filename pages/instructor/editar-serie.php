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
	<title>Daale - Editar serie</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
	<script type="text/javascript">
		function desplegar(_valor){
			document.getElementById('nombre').style.visibility=_valor;
		}
	</script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Ejercicio agregado
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
		if ($_SESSION['editarS']==0) {
		}else if ($_SESSION['editarS']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarS']=0;
		}else if ($_SESSION['editarS']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['editarS']=0;
		}else if ($_SESSION['editarS']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarS']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$id=$_REQUEST['id'];
		$query = "SELECT * FROM instructor I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_i=$row['ID_Instructor'];
			$queryS = "SELECT * FROM series WHERE ID_Series='$id'";
			$resultadoS = $conexion->query($queryS);
			while($rowS = $resultadoS->fetch_assoc()){
	 ?>
	 <div class="modal" id="nombre">
 	 <div class="modal-contenido">
 		 <div class="arriba-editar"><!--modificar-->
 			 <div class="izq-titulo">Agregar ejercicio</div>
 			 <a id="close" class="close2" href="javascript:desplegar('hidden');"><span class="fa fa-times"></span></a>
 			 <div class="line-titulo"></div>
 		 </div>
 		 <form action="../../php/instructor/agregar-conjuntoe-dentro.php?id=<?php echo $id; ?>" method="post">
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

 				 <div class="text-left">Selecciona el ejercicio a agregar y presiona listo para guardar los cambios.  </div>
 				 <div class="abajo-botones">
 					 <input type="submit" value="Listo" id="boton-listo">
 					 <div id="close" class="cancelar">
 						 <a  href="javascript:desplegar('hidden');">Cancelar</a>
 					 </div>
 				 </div>
 		 </form>
 	 </div>
  </div>
	<header>
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Serie</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus series.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/instructor/editar-serie.php?id=<?php echo $id; ?>" method="post">

				<h2>Rellenado de formulario:</h2>
				<div class="text-left3">Nombre del ejercicio</div>
				<div class="text-left4">Repeticiones (Rep's)</div>
				<input  class="pequeño1" type="text" name="nombre" value="<?php echo $rowS['Nombre']; ?>" required>
				<input class="pequeño2" type="number" name="sets" value="<?php echo $rowS['Sets']; ?>" required>
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Ejercicios) FROM conjuntoe WHERE ID_Series='$id'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}

				if ($r!=0) {
				 ?>
				<h2 >Ejercicios seleccionados:</h2>
					<table>
					<tr>
						<th class="arriba-izq">Ejercicio</th>
						<th class="arriba-izq">Reps</th>
						<th class="text-eliminar" style="text-align:right; padding-right:15px;">Eliminar</th>
					</tr>
					<?php
					$query3=("SELECT C.ID_ConjuntoE, A.Nombre, A.Reps FROM conjuntoe C INNER JOIN ejercicios A WHERE C.ID_Series='$id'  AND C.ID_Ejercicios=A.ID_Ejercicios");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					$id_c=$row3['ID_ConjuntoE'];
					?>
					<tr>
						<td style="text-align:left;"><?php echo $row3['Nombre']; ?></td>
						<td style="text-align:left;"><?php echo $row3['Reps']; ?></td>
						<td class="cambiar"> <a href="../../php/instructor/eliminar-conjuntoe.php?id=<?php echo $id_c ?>"><span class="fa fa-trash"></span></a></td>
					</tr>
					<?php } ?>
				</table>
				<input class="boton-clave" style="margin-top:-30px;" onclick="desplegar('visible');" type="button" name="foto-alimento" value="Agregar ejercicio">
			<?php } else{?>
		 		<h2 >No hay ejercicios en la serie</h2>
				<input class="boton-clave" onclick="desplegar('visible');" type="button" name="foto-alimento" value="Agregar ejercicio">
			<?php } ?>

					<input type="submit" value="Editar" id="boton" >
					<div class="text-left">Modifica la información de tu serie y presiona el </div>
					<div class="text-left">botón editar para guardar lo cambios realizados.</div>
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } }?>
</body>
</html>
