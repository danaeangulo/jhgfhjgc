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
	<title>Daale - Editar rutina</title>
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
				Serie agregada
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Serie eliminada
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
		if ($_SESSION['editarR']==0) {
		}else if ($_SESSION['editarR']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarR']=0;
		}else if ($_SESSION['editarR']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['editarR']=0;
		}else if ($_SESSION['editarR']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarR']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$id=$_REQUEST['id'];
		$query = "SELECT * FROM instructor I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_i=$row['ID_Instructor'];
			$queryR = "SELECT * FROM rutinas WHERE ID_Rutinas='$id'";
			$resultadoR = $conexion->query($queryR);
			while($rowR = $resultadoR->fetch_assoc()){
				$sexo=$rowR['Sexo'];
				$meta=$rowR['Meta'];
				$cuerpo=$rowR['Cuerpo'];
	 ?>
	 <div class="modal" id="nombre">
 	 <div class="modal-contenido">
 		 <div class="arriba-editar"><!--modificar-->
 			 <div class="izq-titulo">Agregar serie</div>
 			 <a id="close" class="close2" href="javascript:desplegar('hidden');"><span class="fa fa-times"></span></a>
 			 <div class="line-titulo"></div>
 		 </div>
 		 <form action="../../php/instructor/agregar-conjuntos-dentro.php?id=<?php echo $id; ?>" method="post">
  				<div class="text-left">Serie</div>
  				<select name="serie" required>
  					<?php
  						$query2 = "SELECT * FROM series WHERE ID_Instructor='$id_i'";
  						$resultado2 = $conexion->query($query2);
  					 	while($row2 = $resultado2->fetch_assoc()){

  					?>
  					<option value="<?php echo $row2['ID_Series']; ?>" require><?php echo $row2['Nombre']; ?></option>
  				<?php } ?>
  				</select>

 				 <div class="text-left">Selecciona la serie a agregar y presiona listo para guardar los cambios.  </div>
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
			<h2 >Editar Rutina</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus rutinas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/instructor/editar-rutina.php?id=<?php echo $id ?>" method="post">
				<h2>Rellenado de formulario:</h2>
				<div class="text-left">Nombre de la rutina:	</div>
				<input  class="pequeño" type="text" name="nombre" value="<?php echo $rowR['Nombre']; ?>" required>

				<div class="text-izq">Tiempo total (min):</div>
				<div class="text-der">Tiempo de descanso entre ejercicios (min):</div>
				<input class="pequeño1" type="number" name="total" value="<?php echo $rowR['Tiempo_Total']; ?>" required>
				<input class="pequeño2" type="number" name="descanso" value="<?php echo $rowR['Tiempo_Descanso']; ?>" required>

				<div class="text-left">Descripción:</div>
				<textarea name="descripcion" required><?php echo $rowR['Descripcion']; ?></textarea>

				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Series) FROM conjuntos	WHERE ID_Rutinas='$id'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}
				if ($r!=0) {
				 ?>
				 <h2>Series de tu rutina:</h2>
					<table>
					<tr>
						<th class="arriba-izq">Serie</th>
						<th class="arriba-izq">Sets</th>
						<th class="text-eliminar" style="text-align:right; padding-right:15px;">Eliminar</th>
					</tr>
					<?php
					$query3=("SELECT C.ID_ConjuntoS, A.Nombre, A.Sets FROM conjuntos C INNER JOIN series A WHERE C.ID_Rutinas='$id'  AND C.ID_Series=A.ID_Series");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					$id_c=$row3['ID_ConjuntoS'];
					?>
					<tr>
						<td style="text-align:left;"><?php echo $row3['Nombre']; ?></td>
						<td style="text-align:left;"><?php echo $row3['Sets']; ?></td>
						<td class="cambiar"> <a href="../../php/instructor/eliminar-conjuntos.php?id=<?php echo $id_c ?>"><span class="fa fa-trash"></span></a></td>
					</tr>
					<?php } ?>
				</table>

				<input class="boton-clave" style="margin-top:-30px;" onclick="desplegar('visible');" type="button" name="foto-alimento" value="Agregar serie">
			<?php } else{?>
				<h2>No hay series en la rutina</h2>
				<input class="boton-clave"  onclick="desplegar('visible');" type="button" name="foto-alimento" value="Agregar serie">
			<?php } ?>
				<h2>¿Hacia quién va dirigida?</h2>
				<div class="text-left1">Tipo de cuerpo</div>
				<div class="text-left2">Objetivo de peso</div>
				<div class="text-left2">Sexo</div>
				<?php
					if ($cuerpo==1) {
				?>
				<select name="cuerpo" class="medio1">
					<option value="1" required>Hectomorfo</option>
					<option value="2">Mesomorfo</option>
					<option value="3">Endomorfo</option>
				</select>
				<?php
					}if ($cuerpo==2) {
				?>
				<select name="cuerpo" class="medio1">
					<option value="2" require>Mesomorfo</option>
					<option value="1">Hectomorfo</option>
					<option value="3">Endomorfo</option>
				</select>
				<?php
					}if ($cuerpo==3) {
				?>
				<select name="cuerpo" class="medio1">
					<option value="3" require>Endomorfo</option>
					<option value="1">Hectomorfo</option>
					<option value="2">Mesomorfo</option>
				</select>
				<?php
					}
					if ($meta==1) {
				?>
				<select name="meta" class="medio2">
					<option value="1" required>Aumentar</option>
					<option value="0">Bajar</option>
				</select>
				<?php }else{ ?>
					<select name="meta" class="medio2">
						<option value="0" required>Bajar</option>
						<option value="1">Aumentar</option>
					</select>
				<?php
					}
					if ($sexo=="H") {
				?>
				<select name="sexo" class="medio3">
					<option value="H" required>Hombre</option>
					<option value="M">Mujer</option>
				</select>
				<?php }else{ ?>
					<select name="sexo" class="medio3">
						<option value="M" required>Mujer</option>
						<option value="H">Hombre</option>
					</select>
				<?php
					}
				?>
				<input type="submit" value="Editar" id="boton">
				<div class="text-left">Completa todo el formulario correctamente y presiona agregar.  </div>
		</form>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } }?>
</body>
</html>
