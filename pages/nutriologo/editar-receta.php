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
	<title>Daale - Editar receta</title>
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
		function alimento(_valor){
			document.getElementById('nombre').style.visibility=_valor;
		}
		function foto(_valor){
			document.getElementById('foto-ejercicio').style.visibility=_valor;
		}
	</script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Ingrediente agregado
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Ingrediente eliminado
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
		if ($_SESSION['editarRe']==0) {
		}else if ($_SESSION['editarRe']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarRe']=0;
		}else if ($_SESSION['editarRe']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
				$_SESSION['editarRe']=0;
		}else if ($_SESSION['editarRe']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['editarRe']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$id=$_REQUEST['id'];
		$query = "SELECT * FROM nutriologo I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_i=$row['ID_Nutriologo'];
			$queryS = "SELECT * FROM recetas WHERE ID_Recetas='$id'";
			$resultadoS = $conexion->query($queryS);
			while($rowS = $resultadoS->fetch_assoc()){
	 ?>
	 <div class="modal" id="foto-ejercicio">
 		<div class="modal-contenido">
 			<div class="arriba-editar"><!--modificar-->
 				<div class="izq-titulo">Editar foto de la receta</div>
 				<a id="close" class="close2" href="javascript:foto('hidden');"><span class="fa fa-times"></span></a>
 				<div class="line-titulo"></div>
 			</div>
 			<form action="../../php/nutriologo/cambiar-foto-receta.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
 					<div class="text-left">Seleccionar foto de la receta</div>
 					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

 					<div class="text-left">Modifica la foto de tu receta y presiona listo para guardar los cambios.  </div>
 					<div class="abajo-botones">
 						<input type="submit" value="Listo" id="boton-listo">
 						<div id="close" class="cancelar">
 							<a  href="javascript:foto('hidden');">Cancelar</a>
 						</div>
 					</div>
 			</form>
 		</div>
 	</div>
	<div class="modal" id="nombre">
	 <div class="modal-contenido">
		 <div class="arriba-editar"><!--modificar-->
			 <div class="izq-titulo">Agregar alimento</div>
			 <a id="close" class="close2" href="javascript:alimento('hidden');"><span class="fa fa-times"></span></a>
			 <div class="line-titulo"></div>
		 </div>
		 <form action="../../php/nutriologo/agregar-conjuntoa-dentro.php?id=<?php echo $id; ?>" method="post">
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
	<header >
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Editar Receta</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás editar tus recetas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/nutriologo/editar-receta.php?id=<?php echo $id; ?>" method="post">

				<h2>Rellenado de formulario:</h2>
				<div class="text-left3">Nombre de la receta</div>
				<div class="text-left4">Tiempo de preparación (min)</div>
				<input  class="pequeño1" type="text" name="nombre" value="<?php echo $rowS['Nombre']; ?>" required>
				<input class="pequeño2" type="number" name="tiempo" value="<?php echo $rowS['Tiempo_P']; ?>" required>

				<input class="boton-clave" onclick="foto('visible')" type="button" name="foto-alimento" value="Cambiar foto de la receta">

				<br>
				<div class="text-left">Descripción:</div>
				<textarea name="descripcion" required><?php echo $rowS['Descripcion']; ?></textarea>

				<div class="text-left">Pasos:</div>
				<textarea name="pasos" required><?php echo $rowS['Pasos']; ?></textarea>

				<div class="text-left">Consejo:</div>
				<textarea name="consejo" ><?php echo $rowS['Consejo']; ?></textarea>
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Alimentos) FROM conjuntoa WHERE ID_Recetas='$id'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}

				if ($r!=0) {
				 ?>
				<h2>Ingredientes seleccionados:</h2>
					<table >
					<tr>
						<th class="arriba-izq">Ingrediente</th>
						<th class="arriba-izq">Calorias</th>
						<th class="text-eliminar" style="text-align:right; padding-right:15px;">Eliminar</th>
					</tr>
					<?php
					$query3=("SELECT C.ID_ConjuntoA, A.Nombre, A.Calorias FROM conjuntoa C INNER JOIN alimentos A WHERE C.ID_Recetas='$id'  AND C.ID_Alimentos=A.ID_Alimentos");
					$resultado3 = $conexion->query($query3);
					while($row3 = $resultado3->fetch_assoc()){
					$id_c=$row3['ID_ConjuntoA'];
					?>
					<tr>
						<td style="text-align:left;"><?php echo $row3['Nombre']; ?></td>
						<td style="text-align:left;"><?php echo $row3['Calorias']; ?></td>
						<td class="cambiar"> <a href="../../php/nutriologo/eliminar-conjuntoa.php?id=<?php echo $id_c ?>"><span class="fa fa-trash"></span></a></td>
					</tr>
					<?php } ?>
				</table>
				<input class="boton-clave" style="margin-top:-30px;" onclick="alimento('visible')" type="button" name="foto-alimento" value="Agregar ingrediente">
			<?php } else{?>
		 		<h2 >No hay ingredientes en la receta</h2>
				<input class="boton-clave" onclick="alimento('visible')" type="button" name="foto-alimento" value="Agregar ingrediente">
			<?php } ?>
					<input type="submit" value="Editar" id="boton" >
					<div class="text-left">Modifica la información de tu la receta y presiona el   </div>
					<div class="text-left">botón editar para guardar los cambios realizados.</div>
		</form>


		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } }?>
</body>
</html>
