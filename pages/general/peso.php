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
	<title>Daale - Peso</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/peso.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script type="text/javascript">
	function nombre(_valor){
		document.getElementById('nombre').style.visibility=_valor;
	}
	</script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Peso registrado
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Meta registrada
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
	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">¡Felicidades!</div>
				<a id="close" class="close2" href="javascript:nombre('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="" method="post" id="form-meta">
					<div class="text-left">Haz cumplido con tu objetivo de peso, Selecciona una nueva meta.</div>
					<input type="number" name="peso-meta" placeholder="Nueva meta (kg)">
					<div class="text-left">Al omitir continuarás con tu meta actual.</div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo" id="btn">
						<div id="close" class="cancelar">
							<a  href="javascript:nombre('hidden');">Omitir</a>
						</div>
					</div>
			</form>
			<script type="text/javascript">
				jQuery(document).on('submit', '#form-meta', function(event){
					event.preventDefault();
					jQuery.ajax({
						url: '../../php/general/registro-meta.php',
						type: 'POST',
						dataType: 'json',
						data: $(this).serialize(),
						beforeSend: function(){
								$('.btn').val('Actualizando...');
						}
					})
					.done(function(respuesta){
						console.log(respuesta);
						if (!respuesta.error1) {
							if (respuesta.var == 2) {
								location.href = 'peso.php';
							}
						} else if (respuesta.error1 == true) {
							$('#error1').slideDown('slow');
							setTimeout(function(){
									$('#error1').slideUp('slow');
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
		</div>
	</div>
	<?php
	if ($_SESSION['Peso']==0) {
	}else if($_SESSION['Peso']==1){
		echo "<script>";
		echo "$('#alerta1').slideDown('slow');
						setTimeout(function(){
						$('#alerta1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Peso']=0;
	}else if($_SESSION['Peso']==2){
		echo "<script>";
		echo "$('#alerta2').slideDown('slow');
						setTimeout(function(){
						$('#alerta2').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Peso']=0;
	}
	if ($_SESSION['Meta']==0) {
	}else if($_SESSION['Meta']==1){
		echo "<script>";
		echo "document.getElementById('nombre').style.visibility='visible'";
		echo "</script>";
		$_SESSION['Meta']=0;
	}
	 ?>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_general=$row['ID_General'];
			$res=$row['Peso_Meta']-$row['Peso_Act'];
				if($res==0){
			?>
					<!--Mensaje-->
			<?php
				}else if($res>0){
			?>
					<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
			<?php
				}
	 ?>
	</div>
	<header>
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Peso</h2>
			<div class="line"></div>
			<div class="fila1">
<form action="" id="formulario" method="post">
				<div class="vertical-menu">
					<a> Inicial (kg)
						<div class="num2">
								<?php echo $row['Peso_Inicial']; ?>
						</div>
					</a>
					<a class="active">
							Actual (kg)
							<div class="num1">
									<input type="number" name="nuevo" value="<?php echo $row['Peso_Act']; ?>">
							</div>
					</a>
					<a class="final-der"> Final (kg)
						<div class="num2">
								<?php echo $row['Peso_Meta']; ?>
						</div>
					</a>
				</div>
				<input class="registrar1" type="submit" id="btn" value="Registrar peso">
</form>
<script type="text/javascript">
	jQuery(document).on('submit', '#formulario', function(event){
		event.preventDefault();
		jQuery.ajax({
			url: '../../php/general/registro-peso.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function(){
					$('.btn').val('Registrando...');
			}
		})
		.done(function(respuesta){
			console.log(respuesta);
			if (!respuesta.error1) {
				if (respuesta.var == 1) {
					location.href = 'peso.php';
					if (respuesta.meta == true) {
						location.href = 'peso.php';
					}else if (respuesta.meta == false) {
						location.href = 'peso.php';
					}
					$('.btn').val('Registrar peso');
				}
			} else if (respuesta.error1 == true) {
				$('#error1').slideDown('slow');
				setTimeout(function(){
						$('#error1').slideUp('slow');
				}, 3000);
				$('.btn').val('Registrar peso');
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
				<div class="text-left">
					Registra tu peso actual para una mayor precisión en tu desempeño.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Peso) FROM peso WHERE ID_General='$id_general'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$r=$fila0[0];
			}
			if ($r!=0) {
			 ?>
			<div class="fila1">

				<h2>Registros:</h2>
			</div>

			<table class="tabla">
			  <tr>
			    <th>Peso anterior</th>
					<th>Peso nuevo</th>
					<th>Diferencia</th>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Resultado</th>
					<!--
					<th class="text-eliminar">Eliminar</th>
					-->
			  </tr>
				<?php
					$query2 = "SELECT * FROM peso WHERE ID_General='$id_general' ORDER BY ID_Peso DESC";
					$resultado2 = $conexion->query($query2);
					while($row = $resultado2->fetch_assoc()){
			 	?>
			  <tr>
			    <td><?php echo $row['P_Anterior']; ?></td>
			    <td><?php echo $row['P_Nuevo']; ?></td>
					<td>
						<?php
							$anterior=$row['P_Anterior'];
							$nuevo=$row['P_Nuevo'];
							$diferencia=$nuevo-$anterior;
							echo $diferencia;
					 	?>
				 	</td>
			    <td><?php echo $row['Fecha']; ?></td>
					<td><?php echo $row['Hora']; ?></td>
					<td>
						<?php $res=$row['Resultado'];
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
					<!--
					<td class="eliminar"> <a href="../../php/general/eliminar-peso.php?id=<?php echo $row['ID_Peso']; ?>"><span class="fa fa-trash"></span></a></td>
					-->
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
