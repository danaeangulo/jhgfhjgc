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
	<title>Daale - Ver rutina</title>
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
		$id_instructor=$_REQUEST['id'];
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
			<?php
			$queryA = "SELECT * FROM instructor N INNER JOIN user U WHERE N.ID_Instructor='$id_instructor' AND N.User=U.ID_User";
			$resultadoA = $conexion->query($queryA);
			$rowA = $resultadoA->fetch_assoc();
			 ?>
			<h2 style="width:100%;">Rutinas de <?php echo $rowA['Nombre']; ?> <?php echo $rowA['Ap_P']; ?> <?php echo $rowA['Ap_M']; if ($rowA['Validado']==1) {
					?>
					<i class="fa fa-check-circle" aria-hidden="true"></i>
				<?php } ?>
			</h2>
			<div class="line"></div>
			<div class="text-left">
				Tienes la opción de cambiar tu rutina en este apartado.
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
<?php
require("../../php/connect_db.php");
$sql0=("SELECT R.ID_Instructor FROM rutinas R WHERE ID_Rutinas='$id_rutina'");
$query0=mysqli_query($mysqli,$sql0);
while($fila0=mysqli_fetch_array($query0)){
$r=$fila0[0];
}
if ($r==$id_instructor) {
 ?>
		<h2 style="margin-top:-50px;">Tu rutina:</h2>
		<table class="tabla">
			<tr>
				<th class="arriba-izq">Nombre</th>
				<th class="arriba-izq">Tiempo (min)</th>
				<th class="arriba-izq">Cuerpo</th>
				<th class="arriba-izq">Sexo</th>
				<th class="arriba-izq">Objetivo</th>
				<th class="text-eliminar">Seleccionar</th>
			</tr>
			<?php
				$query2 = "SELECT R.ID_Rutinas, R.Nombre AS NR, R.Descripcion, R.Meta, R.Sexo, R.Tiempo_Descanso, R.Tiempo_Total,C.Nombre AS NC FROM rutinas R  INNER JOIN cuerpos C WHERE C.ID_Cuerpos=R.Cuerpo  AND R.ID_Rutinas='$id_rutina'";
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
				<td><?php echo $row2['NC'] ?></td>
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
				<td  class="cambiar">
    				<input type="radio" name="radio" value="<?php echo $rutina ?>" checked>
				</td>
				</tr>
			<?php } ?>
		</table>
<?php } ?>
		<h2 style="margin-top:-50px;">Otras rutinas:</h2>
			<table class="tabla">
				<tr>
					<th class="arriba-izq">Nombre</th>
					<th class="arriba-izq">Tiempo (min)</th>
					<th class="arriba-izq">Cuerpo</th>
					<th class="arriba-izq">Sexo</th>
					<th class="arriba-izq">Objetivo</th>
					<th class="text-eliminar">Seleccionar</th>
				</tr>
				<?php
					$query2 = "SELECT R.ID_Rutinas, R.Nombre AS NR, R.Descripcion, R.Meta, R.Sexo, R.Tiempo_Descanso, R.Tiempo_Total, C.Nombre AS NC FROM rutinas R INNER JOIN cuerpos C WHERE C.ID_Cuerpos=R.Cuerpo  AND R.ID_Instructor='$id_instructor' AND R.ID_Rutinas!='$id_rutina'";
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
					<td  class="cambiar">
						<input type="radio" name="radio" value="<?php echo$rutina ?>" required>
					</td>
					</tr>
				<?php } ?>
			</table>
				<input type="submit" value="Cambiar" name="submit" id="boton"	id="btn">
				<div class="text-left">Selecciona la rutina que más te guste de este instructor.  </div>
		</form>
		<script type="text/javascript">
			jQuery(document).on('submit', '#formulario', function(event){
				event.preventDefault();

				jQuery.ajax({
					url: '../../php/general/ver-rutina.php',
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
							location.href = 'perfil-instructor.php?id=<?php echo $id_instructor ?>';
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
