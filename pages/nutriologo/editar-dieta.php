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
	<title>Daale - Editar dietas</title>
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
	<script type="text/javascript">
		function alimento(_valor){
			document.getElementById('nombre').style.visibility=_valor;
		}
		function receta(_valor){
			document.getElementById('nombre-usuario').style.visibility=_valor;
		}
	</script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Alimento agregado
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Alimento eliminado
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
	<div class="toast alerta3" id="alerta3">
		<div class="toast-contenido">
			<div class="text1">
				Receta agregada
			</div>
		</div>
	</div>
	<div class="toast error2" id="error2">
		<div class="toast-contenido">
			<div class="text1">
				Receta eliminada
			</div>
		</div>
	</div>
	<?php
		if ($_SESSION['editarD']==0) {
		}else if ($_SESSION['editarD']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarD']=0;
		}else if ($_SESSION['editarD']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['editarD']=0;
		}else if ($_SESSION['editarD']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarD']=0;
		}else if ($_SESSION['editarD']==4) {
			echo "<script>";
			echo "$('#alerta3').slideDown('slow');
							setTimeout(function(){
							$('#alerta3').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarD']=0;
		}else if ($_SESSION['editarD']==5) {
			echo "<script>";
			echo "$('#error2').slideDown('slow');
							setTimeout(function(){
							$('#error2').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['editarD']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$id=$_REQUEST['id'];
		$query = "SELECT * FROM nutriologo I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_i=$row['ID_Nutriologo'];
			$queryS = "SELECT * FROM dietas WHERE ID_Dietas='$id'";
			$resultadoS = $conexion->query($queryS);
			while($rowS = $resultadoS->fetch_assoc()){
				$sexo=$rowS['Sexo'];
				$meta=$rowS['Meta'];
				$cuerpo=$rowS['Cuerpo'];
	 ?>
	 <div class="modal" id="nombre">
 	 <div class="modal-contenido">
 		 <div class="arriba-editar"><!--modificar-->
 			 <div class="izq-titulo">Agregar alimento</div>
 			 <a id="close" class="close2" href="javascript:alimento('hidden');"><span class="fa fa-times"></span></a>
 			 <div class="line-titulo"></div>
 		 </div>
 		 <form action="../../php/nutriologo/agregar-conjuntora-dentro.php?id=<?php echo $id; ?>" method="post">
  				<div class="text-left">Alimento</div>
  				<select name="alimento" required>
  					<?php
  						$query2 = "SELECT * FROM alimentos WHERE ID_Nutriologo='$id_i'";
  						$resultado2 = $conexion->query($query2);
  					 	while($row2 = $resultado2->fetch_assoc()){
  					?>
  					<option value="<?php echo $row2['ID_Alimentos']; ?>" require><?php echo $row2['Nombre']; ?></option>
  				<?php } ?>
  				</select>

 				 <div class="text-left">Selecciona el alimento a agregar y presiona listo para guardar los cambios.  </div>
 				 <div class="abajo-botones">
 					 <input type="submit" value="Listo" id="boton-listo">
 					 <div id="close" class="cancelar">
 						 <a  href="javascript:alimento('hidden');">Cancelar</a>
 					 </div>
 				 </div>
 		 </form>
 	 </div>
  </div>
	<div class="modal" id="nombre-usuario">
	 <div class="modal-contenido">
		 <div class="arriba-editar"><!--modificar-->
			 <div class="izq-titulo">Agregar receta</div>
			 <a id="close" class="close2" href="javascript:receta('hidden');"><span class="fa fa-times"></span></a>
			 <div class="line-titulo"></div>
		 </div>
		 <form action="../../php/nutriologo/agregar-conjuntor-dentro.php?id=<?php echo $id; ?>" method="post">
 				<div class="text-left">Receta</div>
 				<select name="receta" required>
 					<?php
 						$query2 = "SELECT * FROM recetas WHERE ID_Nutriologo='$id_i'";
 						$resultado2 = $conexion->query($query2);
 					 	while($row2 = $resultado2->fetch_assoc()){
 					?>
 					<option value="<?php echo $row2['ID_Recetas']; ?>" require><?php echo $row2['Nombre']; ?></option>
 				<?php } ?>
 				</select>

				 <div class="text-left">Selecciona la receta a agregar y presiona listo para guardar los cambios.  </div>
				 <div class="abajo-botones">
					 <input type="submit" value="Listo" id="boton-listo">
					 <div id="close" class="cancelar">
						 <a  href="javascript:receta('hidden');">Cancelar</a>
					 </div>
				 </div>
		 </form>
	 </div>
 </div>
	<header >
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Dietas</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus dietas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/nutriologo/editar-dieta.php?id=<?php echo $id ?>" method="post">
				<h2>Rellenado de formulario:</h2>
				<div class="text-left">Nombre de la dieta:	</div>
				<input  class="pequeño" type="text" name="nombre" value="<?php echo $rowS['Nombre']; ?>" required>

				<div class="text-left">Descripción:</div>
				<textarea name="descripcion" required><?php echo $rowS['Descripcion']; ?></textarea>

				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Alimentos) FROM conjuntora WHERE ID_Dietas='$id'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}

				if ($r!=0) {
			 	?>
				<h2>Alimentos seleccionados:</h2>
					<table>
					<tr>
						<th class="arriba-izq">Alimento</th>
						<th class="arriba-izq">Calorias</th>
						<th class="text-eliminar" style="text-align:right; padding-right:15px;">Eliminar</th>
					</tr>
					<?php
					$query3=("SELECT C.ID_ConjuntoRA, A.Nombre, A.Calorias FROM conjuntora C INNER JOIN alimentos A WHERE C.ID_Dietas='$id'  AND C.ID_Alimentos=A.ID_Alimentos");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					$id_c=$row3['ID_ConjuntoRA'];
					?>
					<tr>
						<td style="text-align:left;"><?php echo $row3['Nombre']; ?></td>
						<td style="text-align:left;"><?php echo $row3['Calorias']; ?></td>
						<td class="cambiar"> <a href="../../php/nutriologo/eliminar-conjuntora.php?id=<?php echo $id_c ?>"><span class="fa fa-trash"></span></a></td>
					</tr>
					<?php } ?>
				</table>
				<input class="boton-clave" style="margin-top:-30px;" onclick="alimento('visible')" type="button" name="foto-alimento" value="Agregar alimento">
			<?php } else{?>
				<h2 >No hay alimentos en la dieta</h2>
				<input class="boton-clave" onclick="alimento('visible')" type="button" name="foto-alimento" value="Agregar alimento">
			<?php } ?>

				<?php
				$sql0=("SELECT COUNT(ID_Recetas) FROM conjuntor WHERE ID_Dietas='$id'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}

				if ($r!=0) {
				?>
				<h2>Recetas seleccionadas:</h2>
					<table>
					<tr>
						<th class="arriba-izq">Receta</th>
						<th class="arriba-izq">Calorias</th>
						<th class="text-eliminar" style="text-align:right; padding-right:15px;">Eliminar</th>
					</tr>
					<?php
					$query3=("SELECT C.ID_ConjuntoR, A.Nombre, A.Calorias FROM conjuntor C INNER JOIN recetas A WHERE C.ID_Dietas='$id'  AND C.ID_Recetas=A.ID_Recetas");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					$id_c=$row3['ID_ConjuntoR'];
					?>
					<tr>
						<td style="text-align:left;"><?php echo $row3['Nombre']; ?></td>
						<td style="text-align:left;"><?php echo $row3['Calorias']; ?></td>
						<td class="cambiar"> <a href="../../php/nutriologo/eliminar-conjuntor.php?id=<?php echo $id_c ?>"><span class="fa fa-trash"></span></a></td>
					</tr>
					<?php } ?>
				</table>
				<input class="boton-clave" style="margin-top:-30px;" onclick="receta('visible')" type="button" name="foto-alimento" value="Agregar receta">
			<?php } else{?>
				<h2 >No hay recetas en la dieta</h2>
				<input class="boton-clave" onclick="receta('visible')" type="button" name="foto-alimento" value="Agregar receta">
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
				<div class="text-left">Completa todo el formulario correctamente y presiona editar.  </div>
		</form>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } }?>
</body>
</html>
