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
		if ($_SESSION['PerfilG']==0) {
		}else if($_SESSION['PerfilG']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilG']=0;
		}else if($_SESSION['PerfilG']==2){
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilG']=0;
		}else if($_SESSION['PerfilG']==3){
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilG']=0;
		}else if($_SESSION['PerfilG']==4){
			echo "<script>";
			echo "$('#error2').slideDown('slow');
							setTimeout(function(){
							$('#error2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['PerfilG']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G INNER JOIN user U ON G.User= U.ID_User WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>

	<div class="modal" id="foto-perfil">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar foto de perfil</div>
				<a id="close" class="close2" href="javascript:fotoperfil('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-foto-perfil.php" method="post" id="form-foto" enctype="multipart/form-data">
					<div class="text-left">Seleccionar foto de perfil</div>
					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

					<div class="text-left">Modifica tu foto de perfil y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo" id="btn">
						<div id="close" class="cancelar">
							<a  href="javascript:fotoperfil('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
<!--
			<script type="text/javascript">
				jQuery(document).on('submit', '#form-foto', function(event){
					event.preventDefault();
					jQuery.ajax({
						url: '../../php/general/cambiar-foto-perfil.php',
						type: 'POST',
						contentType:false,
						dataType: 'json',
						data: $(this).serialize(),
						beforeSend: function(){
								$('.btn').val('Cambiando...');
						}
					})
					.done(function(respuesta){
						console.log(respuesta);
						if (!respuesta.error2) {
							if (respuesta.var == 1) {
								document.getElementById('clave').style.visibility="hidden";
								$('#alerta2').slideDown('slow');
								setTimeout(function(){
										$('#alerta2').slideUp('slow');
								}, 3000);
							}
						} else if (respuesta.error2 == true) {
							$('#error2').slideDown('slow');
							setTimeout(function(){
									$('#error2').slideUp('slow');
							}, 3000);
							$('.btn').val('Listo');
						}
					})
					.fail(function(resp){
						console.log(resp);
					})
					.always(function(respuesta){
						console.log("complete");
					});
				});
			</script>
		-->
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
									?>
									<img src="../../images/perfil.png" alt="" style="margin-top:-20px;">
									<?php
							}
						 ?>
						<a href="javascript:fotoperfil('visible');" class="registrar1"> <span class="fa fa-camera"></span>&nbsp Actualizar foto</a>

					</div>
				</form>

				<div class="informacion-perfil2">
					<div class="user">
						<?php echo $row['User']; ?>
					</div>
					<div class="nombre">
						<?php echo $row['Nombre']; ?>&nbsp(<?php echo $row['Fech_Nac']; ?>)
					</div>
					<div class="text-left">
						Esta cuenta es privada y ningún otro usuario podrá acceder a tu perfil.
					</div>

					<div class="tres3">
						<div class="edad">
							Edad:
							<div class="info">
								<?php $fech_nac= $row['Fech_Nac']; ?>
								<?php
								$cumpleanos = new DateTime("$fech_nac");
						    $hoy = new DateTime();
						    $annos = $hoy->diff($cumpleanos);
						    echo $annos->y; ?>

							</div>
						</div>
						<div class="altura">
							Altura:
							<div class="info">
								<?php echo $row['Altura']; ?>
							</div>
						</div>
						<div class="peso">
							Peso:
							<div class="info">
								<?php echo $row['Peso_Act']; ?>
							</div>
						</div>
					</div>

				<div class="tres3" style="margin-top:140px;">
					<?php
					$query2 = "SELECT I.ID_Instructor, I.Nombre, I.Ap_P, I.Ap_M, I.Validado, G.Rutina FROM instructor I INNER JOIN general G INNER JOIN rutinas R WHERE G.User='$user' AND R.ID_Rutinas=G.Rutina AND I.ID_Instructor=R.ID_Instructor";
					$resultado2 = $conexion->query($query2);
					$row2 = $resultado2->fetch_assoc();
					$validado=$row2['Validado'];
					$rutina=$row2['Rutina'];
					$nombre=$row2['Nombre'];
					$ap_p=$row2['Ap_P'];
					$ap_m=$row2['Ap_M'];
					 ?>
					<div class="nombre">
						Instructor:
						<div class="info">
							<?php
								if ($rutina==0) {
									?><div class="text-left">
										No tienes una rutina<a href="seleccionar-rutina.php">, selecciónala aquí.</a>
									</div><?php
								}else{
									?><div class="info"><a href="perfil-instructor.php?id=<?php echo $row2['ID_Instructor']; ?>">
									<?php echo $nombre;?>&nbsp<?php echo $ap_p;?>&nbsp<?php echo $ap_m;?>&nbsp;
									<?php
										if ($validado==1) {
										?>
										<i class="fa fa-check-circle" aria-hidden="true"></i>
									<?php } ?></a>
									</div><?php
								}
							 ?>

						</div>
					</div>
					<div class="nombre">
						<?php
						$query3 = "SELECT I.ID_Nutriologo, I.Nombre, I.Ap_P, I.Ap_M, I.Validado, G.Dieta FROM nutriologo I INNER JOIN general G INNER JOIN dietas R WHERE G.User='$user' AND R.ID_Dietas=G.Dieta AND I.ID_Nutriologo=R.ID_Nutriologo";
						$resultado3 = $conexion->query($query3);
						$row3 = $resultado3->fetch_assoc();
						$validadoN= $row3['Validado'];
						 ?>
						Nutriólogo:
						<div class="info">
							<?php
								if ($row3['Dieta']==0) {
									?><div class="text-left">
										No tienes una dieta<a href="seleccionar-dieta.php">, selecciónala aquí.</a>
									</div><?php
								}else{
									?><div class="info"><a href="perfil-nutriologo.php?id=<?php echo $row3['ID_Nutriologo']; ?>">
									<?php echo $row3['Nombre'];?>&nbsp<?php echo $row3['Ap_P'];?>&nbsp<?php echo $row3['Ap_M'];?>&nbsp;
									<?php
										if ($validadoN==1) {
										?>
										<i class="fa fa-check-circle" aria-hidden="true"></i>
									<?php } ?></a>
									</div><?php
								}
							 ?>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="h2">
		Información de avances:
	</div>
		<table class="avances">
			<tr>
				<th>Peso inicial (kg)</th>
				<th>Peso actual (kg)</th>
				<th>Diferencia de peso (kg)</th>
				<th>Peso a alcanzar (kg)</th>
				<th>Peso restante (kg)</th>
			</tr>
			<tr>
				<td style="text-align:center;"><?php echo $row['Peso_Inicial']; ?></td>
				<td style="text-align:center;"><?php echo $row['Peso_Act']; ?></td>
				<td style="text-align:center;">
					<?php
					$inicial=$row['Peso_Inicial'];
					$actual= $row['Peso_Act'];
					$diferencia=$actual-$inicial;
					echo $diferencia;
					?>
				</td>
				<td style="text-align:center;"><?php echo $row['Peso_Meta']; ?></td>
				<td style="text-align:center;">
					<?php
						$actual= $row['Peso_Act'];
						$meta=$row['Peso_Meta'];
						$restante=$meta-$actual;
						echo $restante;
					 ?>
				</td>
			</tr>
		</table>
		<div class="text-left">Puedes esitar la información de las dos primeras tablas mediante el botón que se encuentra en la parte superior derecha de la página.</div>
		<div class="text-left"><a href="#">Más información.</a></div>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
	<?php
		}
	 ?>
</body>
</html>
