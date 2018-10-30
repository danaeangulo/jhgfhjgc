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
	<title>Daale - Perfil</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil-general.css">
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
		function fotocertificado(_valor){
			document.getElementById('foto-certificado').style.visibility=_valor;
		}
		function fotoperfil(_valor){
			document.getElementById('foto-perfil').style.visibility=_valor;
		}
</script>
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
				Foto actualizada
			</div>
		</div>
	</div>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Error de tamaño de la foto
			</div>
		</div>
	</div>
	<div class="toast error2" id="error2">
		<div class="toast-contenido">
			<div class="text1">
				Error
			</div>
		</div>
	</div>
	<?php
		if ($_SESSION['PerfilN']==0) {
		}else if($_SESSION['PerfilN']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilN']=0;
		}else if($_SESSION['PerfilN']==2){
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilN']=0;
		}else if($_SESSION['PerfilN']==3){
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilN']=0;
		}else if($_SESSION['PerfilN']==4){
			echo "<script>";
			echo "$('#error2').slideDown('slow');
							setTimeout(function(){
							$('#error2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilN']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM nutriologo N INNER JOIN user U ON N.User=U.ID_User WHERE N.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$validado=$row['Validado'];
		$id_nutriologo=$row['ID_Nutriologo'];
	 ?>
	<header>
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
	<div class="modal" id="foto-perfil">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar foto de perfil</div>
				<a id="close" class="close2" href="javascript:fotoperfil('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/nutriologo/cambiar-foto-perfil.php" method="post" enctype="multipart/form-data">
					<div class="text-left">Seleccionar foto de perfil</div>
					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

					<div class="text-left">Modifica tu foto de perfil y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:fotoperfil('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="foto-certificado">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar foto de certificado</div>
				<a id="close" class="close2" href="javascript:fotocertificado('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/nutriologo/cambiar-foto-certificado.php" method="post" enctype="multipart/form-data">
					<div class="text-left">Seleccionar foto de certificado</div>
					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

					<div class="text-left">Modifica tu foto de certificado y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:fotocertificado('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Perfil</h2>
			<a id="boton-derecha" href="editar-perfil.php"><span class="fa fa-pencil"></span>&nbsp&nbspEditar</a>
			<div class="line"></div>
			<div class="fila1">
				<form>
					<div class="foto-perfil">
						<?php
							if ($row['Foto_Perfil']) {
								?>
	 							<img src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Perfil'])?>" alt="" style="margin-top:-20px;">
								<?php
							}else{
								if ($row['Validado']==0) {
									?>
									<img src="../../images/perfil.png" alt="" style="margin-top:-20px;">
									<?php
								}else{
									?>
									<img src="../../images/perfil-verificado.png" alt="" style="margin-top:-20px;">
									<?php
								}
							}
						 ?>
						<a href="javascript:fotoperfil('visible');" class="registrar1"> <span class="fa fa-camera"></span>&nbsp Actualizar foto</a>
						<div class="h2" style="margin-top:20px; margin-bottom:35px;">
							Certificado:
						</div>
						<?php
							if ($row['Foto_Certificado']) {
								?>
								<img src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Certificado'])?>" alt="" style="margin-top:-20px;">
								<?php
							}else{
									?>
									<img src="../../images/certificado.png" alt="" style="margin-top:-20px;">
									<?php
							}
						 ?>
						 <?php
 							if ($row['Validado']==0) {
 								?>
								<a href="javascript:fotocertificado('visible');" class="registrar1" > <span class="fa fa-camera"></span>&nbsp Subir certificado</a>
						<?php } ?>
						</div>
				</form>

				<div class="informacion-perfil2">

					<div class="user">
						<?php echo $row['User']; if ($row['Validado']==1) {
						?>
						<i class="fa fa-check-circle" aria-hidden="true"></i>
					<?php } ?>
					</div>
					<div class="nombre">
						<?php echo $row['Nombre'];?>&nbsp<?php echo $row['Ap_P'];?>&nbsp<?php echo $row['Ap_M'];?>&nbsp(<?php echo $row['Fech_Nac']; ?>)
					</div>
					<div class="text-left">
						Esta cuenta es pública, todo usuario general podrá acceder a tu perfil.
					</div>

					<div class="tres3">
						<div class="edad">
							Teléfono:
							<div class="info">
								<?php echo $row['Telefono']; ?>
							</div>
						</div>
						<div class="altura">
							E-mail:
							<div class="info">
								<?php echo $row['Correo']; ?>

							</div>
						</div>
					</div>

			</div>
	</div>
	<div class="h2">
		Cantidad de aspectos subidos:
	</div>
		<table>
			<tr>
				<th>Dietas</th>
				<th>Recetas</th>
				<th>Alimentos</th>
			</tr>
			<tr>
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Dietas) FROM dietas WHERE ID_Nutriologo='$id_nutriologo'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Recetas) FROM recetas WHERE ID_Nutriologo='$id_nutriologo' ");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$s=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Alimentos) FROM alimentos WHERE ID_Nutriologo='$id_nutriologo'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$e=$fila0[0];
				}
				 ?>
				<td style="text-align:center;"><?php echo $r; ?></td>
				<td style="text-align:center;"><?php echo $s; ?></td>
				<td style="text-align:center;"><?php echo $e; ?></td>
			</tr>
		</table>
		<div class="text-left">Manipula la información de tu perfil y cuenta.</div>
		<div class="text-left"><a href="#">Más información.</a></div>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
	<?php
		}
	 ?>
</body>
</html>
