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
	<title>Daale - Cambiar rutina</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Sin modificaciones
			</div>
		</div>
	</div>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN general G ON G.User=U.ID_User  WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_rutina=$row['Rutina'];
		if ($id_rutina==0) {
			header("Location:seleccionar-rutina.php");
		}
	 ?>
	<header>
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Cambiar Rutina</h2>
			<div class="line"></div>
			<div class="text-left">
				Aquí podrás seleccionar la rutina que se adapte mejor a tus propias comodidades.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>
			<h2 >Filtro:</h2>
		<div style="width:100%; margin-bottom:100px;">
			<div class="edad">
				Cuerpo
				<div class="info">
					<?php
					$id_cuerpo= $row['Tipo_Cuerpo'];
					$queryC = "SELECT Nombre FROM cuerpos WHERE ID_Cuerpos='$id_cuerpo'";
					$resultadoC = $conexion->query($queryC);
					$rowC = $resultadoC->fetch_assoc();
					echo $rowC['Nombre'];
					?>
				</div>
			</div>
			<div class="altura">
				Sexo
				<div class="info">
					<?php
					if($row['Sexo']=='M'){
						echo "Mujer";
					}else{
						echo "Hombre";
					}
					?>
				</div>
			</div>
			<div class="peso">
				Objetivo
				<div class="info">
					<?php
					$res=$row['Peso_Meta']-$row['Peso_Act'];
						if($res>0){
					?>
							<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
					<?php
					}else{
					?>
							<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
					<?php
						}
					?>
				</div>
			</div>
		</div>
<form style="margin-top:50px;" action="" id="formulario" method="post">
		<h2 style="margin-top:-50px;">Rutina seleccionada:</h2>
		<table class="tabla">
			<tr>
				<th class="arriba-izq">Nombre</th>
				<th class="arriba-izq">Tiempo (min)</th>
				<th class="arriba-izq">Personas usándola</th>
				<th class="arriba-izq">Instructor</th>
				<!--
				<th class="arriba-izq">Cuerpo</th>
				<th class="arriba-izq">Sexo</th>
				<th class="arriba-izq">Objetivo</th>
			-->
				<th class="text-eliminar">Seleccionar</th>
			</tr>
			<?php
				$query2 = "SELECT R.ID_Rutinas, R.ID_Instructor, R.Nombre AS NR, R.Descripcion, R.Meta, R.Sexo, R.Tiempo_Descanso, R.Tiempo_Total,C.Nombre AS NC, R.ID_Instructor FROM rutinas R  INNER JOIN cuerpos C WHERE C.ID_Cuerpos=R.Cuerpo AND R.ID_Rutinas='$id_rutina'";
				$resultado2 = $conexion->query($query2);
				while($row2 = $resultado2->fetch_assoc()){
				$rutina=$row2['ID_Rutinas'];
				$instructor=$row2['ID_Instructor'];
			?>
			 <tr>
				<td><?php echo $row2['NR']; ?></td>

				<td>
					Total: <?php echo $row2['Tiempo_Total'] ?><br/><br/>
					Descanso:<br/><?php echo $row2['Tiempo_Descanso'] ?>
				</td>
				<td><?php
					require("../../php/connect_db.php");
					$sql0=("SELECT COUNT(Rutina) FROM general WHERE Rutina='$rutina'");
					$query0=mysqli_query($mysqli,$sql0);
					while($fila0=mysqli_fetch_array($query0)){
					$r=$fila0[0];
					}
					echo $r;

				?></td>
				<td><?php
					$queryN = "SELECT R.ID_Instructor, I.Nombre, I.Ap_P, I.Ap_M, I.Validado, U.User FROM instructor I INNER JOIN user U INNER JOIN rutinas R WHERE I.User=U.ID_User AND I.ID_Instructor='$instructor'";
					$resultadoN = $conexion->query($queryN);
					$rowN = $resultadoN->fetch_assoc();
					?>
					<a href="perfil-instructor.php?id=<?php echo $instructor;?>"><?php
					echo $rowN['User'];
					if ($rowN['Validado']==1) {
							?>
							<i class="fa fa-check-circle" aria-hidden="true"></i>
						<?php }
				?></a></td>
				<!-- <?php /*
				<td><?php echo $row2['NC']; ?></td>
				<td style="padding-left:15px;"><?php echo $row2['Sexo'] ?></td>
				<td style="padding-left:15px;">
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
				*/ ?> -->
				<td  class="cambiar">
    				<input type="radio" name="radio" value="<?php echo $rutina ?>" checked>
				</td>
				</tr>
			<?php } ?>
		</table>
		<h2 style="margin-top:-50px;">Seleccionar otra rutina:</h2>
			<table class="tabla">
				<tr>
					<th class="arriba-izq">Nombre</th>
					<th class="arriba-izq">Tiempo (min)</th>
					<th class="arriba-izq">Personas usándola</th>
					<th class="arriba-izq">Instructor</th>
					<!--
					<th class="arriba-izq">Cuerpo</th>
					<th class="arriba-izq">Sexo</th>
					<th class="arriba-izq">Objetivo</th>
				-->
					<th class="text-eliminar">Seleccionar</th>
				</tr>
				<?php
					$query2 = "SELECT R.ID_Rutinas, R.ID_Instructor, R.Nombre AS NR, R.Descripcion, R.Meta, R.Sexo, R.Tiempo_Descanso, R.Tiempo_Total, C.Nombre AS NC FROM rutinas R INNER JOIN cuerpos C WHERE C.ID_Cuerpos=R.Cuerpo AND R.ID_Rutinas!='$id_rutina'";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){
					$rutina=$row2['ID_Rutinas'];
					$instructor=$row2['ID_Instructor'];
				?>
				 <tr>
					<td><?php echo $row2['NR'] ?></td>
					<td>
						Total: <?php echo $row2['Tiempo_Total'] ?><br/><br/>
						Descanso:<br/><?php echo $row2['Tiempo_Descanso'] ?>
					</td>
					<td><?php
						require("../../php/connect_db.php");
						$sql0=("SELECT COUNT(Rutina) FROM general WHERE Rutina='$rutina'");
						$query0=mysqli_query($mysqli,$sql0);
						while($fila0=mysqli_fetch_array($query0)){
						$r=$fila0[0];
						}
						echo $r;

					?></td>
					<td><?php
						$queryN = "SELECT I.ID_Instructor, I.Nombre, I.Ap_P, I.Ap_M, I.Validado, U.User FROM instructor I INNER JOIN user U INNER JOIN rutinas R WHERE I.User=U.ID_User AND I.ID_Instructor='$instructor'";
						$resultadoN = $conexion->query($queryN);
						$rowN = $resultadoN->fetch_assoc();
						?>
						<a href="perfil-instructor.php?id=<?php echo $instructor;?>"><?php
						echo $rowN['User'];
						if ($rowN['Validado']==1) {
								?>
								<i class="fa fa-check-circle" aria-hidden="true"></i>
							<?php }
					?></a></td>
					<!-- <?php /*
					<td><?php echo $row2['NC'] ?></td>
					<td style=""><?php echo $row2['Sexo'] ?></td>
					<td style="">
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
					*/ ?> -->
					<td  class="cambiar">
						<input type="radio" name="radio" value="<?php echo$rutina ?>" required>
					</td>
					</tr>
				<?php } ?>
			</table>
				<input type="submit" value="Cambiar" name="submit" id="boton"	id="btn">
				<div class="text-left">Selecciona la rutina que más te guste, verifica que el instructor que la creó esté validado para un mejor desempeño.  </div>
		</form>
		<script type="text/javascript">
			jQuery(document).on('submit', '#formulario', function(event){
				event.preventDefault();

				jQuery.ajax({
					url: '../../php/general/cambiar-rutina.php',
					type: 'POST',
					dataType: 'json',
					data: $(this).serialize(),
					beforeSend: function(){
							$('.btn').val('Cambiando...');
					}
				})
				.done(function(respuesta){
					console.log(respuesta);
					if (!respuesta.error1) {
						if (respuesta.var == 1) {
							location.href = 'rutinas.php';
						}
					} else if (respuesta.error1 == true) {
						$('#error1').slideDown('slow');
						setTimeout(function(){
								$('#error1').slideUp('slow');
						}, 3000);
						$('.btn').val('Ingresar');
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
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
