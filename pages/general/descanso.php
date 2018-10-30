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
	<title>Daale - Descanso</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/descanso.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<link rel="stylesheet" href="../../css/toast.css">
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
				Horas registradas
			</div>
		</div>
	</div>
	<div class="toast alerta2" id="alerta2">
		<div class="toast-contenido">
			<div class="text1">
				Registro eliminado
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
	if ($_SESSION['Descanso']==0) {
	}else if($_SESSION['Descanso']==1){
		echo "<script>";
		echo "$('#alerta1').slideDown('slow');
						setTimeout(function(){
						$('#alerta1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Descanso']=0;
	}else if($_SESSION['Descanso']==2){
		echo "<script>";
		echo "$('#alerta2').slideDown('slow');
						setTimeout(function(){
						$('#alerta2').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Descanso']=0;
	}else if($_SESSION['Descanso']==3){
		echo "<script>";
		echo "$('#error1').slideDown('slow');
						setTimeout(function(){
						$('#error1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Descanso']=0;
	}
	 ?>
	<?php
	/*
	if($_REQUEST){
		if($_REQUEST['var']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
		}
		if($_REQUEST['var']==2){
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
		}
		if($_REQUEST['var']==0){
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
		}
	}
	*/
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
			$id_general=$row['ID_General'];
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Descanso</h2>
			<div class="line"></div>
			<div class="fila1">
<form action="" id="formulario" method="post">
				<div class="vertical-menu">
					<a class="active">
							Horas dormidas al día:
							<div class="num1">
									<input type="float" name="horas" value="0">
							</div>
					</a>
				</div>
				<input class="registrar1" type="submit" value="Registrar horas">
</form>
<script type="text/javascript">
	jQuery(document).on('submit', '#formulario', function(event){
		event.preventDefault();
		jQuery.ajax({
			url: '../../php/general/registro-descanso.php',
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
					location.href = 'descanso.php';
					/*
					$('#alerta1').slideDown('slow');
					setTimeout(function(){
							$('#alerta1').slideUp('slow');
					}, 3000);
					$('.btn').val('Registrar horas');
					*/
				}
			} else if (respuesta.error1 == true) {
				$('#error1').slideDown('slow');
				setTimeout(function(){
						$('#error1').slideUp('slow');
				}, 3000);
				$('.btn').val('Registrar horas');
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
					Registra constantemente las horas que has dormido a lo largo de tu estancia en la plataforma.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Descanso) FROM descanso WHERE ID_General='$id_general'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$r=$fila0[0];
			}
			if ($r!=0) {
			 ?>
			<div class="fila1">
				<h2>Registros:</h2>
			</div>
			<?php $descanso=0; ?>
			<table>
			  <tr>
					<th>Horas dormidas</th>
			    <th>Fecha</th>
			    <th>Hora</th>
					<th>Resultado</th>
					<th class="text-eliminar">Eliminar</th>
			  </tr>
				<?php
					$query2 = "SELECT * FROM descanso WHERE ID_General='$id_general' ORDER BY Fecha DESC";
					$resultado2 = $conexion->query($query2);
					while($row2 = $resultado2->fetch_assoc()){

			 	?>
			  <tr>
			    <td><?php echo $row2['Hrs_Dormidas']; ?></td>
					<td><?php echo $row2['Fecha']; ?></td>
			    <td><?php echo $row2['Hora']; ?></td>
					<td>
						<?php
							$res=$row2['Resultado'];
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
					<td class="eliminar"><a href="../../php/general/eliminar-descanso.php?id=<?php echo $row2['ID_Descanso'];?>"><span class="fa fa-trash"></span></a></td>
				</tr>
			<?php } ?>
			</table>
		<?php } ?>
		</div>
  </section>
	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Eliminar</div>
				<a id="close" class="close2" href="javascript:nombre('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
					<div class="text-left" style="font-size:14px;">¿Estás seguro de eliminar este elemento?  </div>
					<div class="abajo-botones">
						<a href="../../php/general/eliminar-descanso.php?id=<?php echo $descanso;?>" id="boton-eliminar">Eliminar</a>
						<?php echo $descanso; ?>
						<div id="close" class="cancelar">
							<a  href="javascript:nombre('hidden');">Cancelar</a>
						</div>
					</div>
		</div>
	</div>
	<?php include('../../partes/footer.php'); ?>

<?php } ?>
</body>
</html>
