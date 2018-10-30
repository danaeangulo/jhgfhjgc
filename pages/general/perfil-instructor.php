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
	<title>Daale - Perfil Instructor</title>
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
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Dieta cambiada
			</div>
		</div>
	</div>
	<?php
	if ($_SESSION['Rutinas']==0) {
	}else if($_SESSION['Rutinas']==1){
		echo "<script>";
		echo "$('#alerta1').slideDown('slow');
						setTimeout(function(){
						$('#alerta1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Rutinas']=0;
	}
		include("../../php/config.php");
		$id=$_REQUEST['id'];
		$query = "SELECT * FROM instructor I INNER JOIN user U ON I.User=U.ID_User WHERE I.ID_Instructor='$id'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$validado=$row['Validado'];
		$id_instructor=$row['ID_Instructor'];
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Perfil Instructor</h2>
			<a id="boton-derecha" href="ver-rutinas.php?id=<?php echo $id_instructor; ?>"><span class="fa fa-eye"></span>&nbsp&nbspVer rutinas</a>
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
				<th>Rutinas</th>
				<th>Series</th>
				<th>Ejercicios</th>
			</tr>
			<tr>
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Rutinas) FROM rutinas WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Series) FROM series WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$s=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Ejercicios) FROM ejercicios WHERE ID_Instructor='$id_instructor'");
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
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
	<?php
		}
	 ?>
</body>
</html>
