<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
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
	<title>Daale - Nutriólogo validado</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/administrador/tablas.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/subheader-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Nutriólogo desvalidado
			</div>
		</div>
	</div>
	<div class="toast error1" id="error1">
		<div class="toast-contenido">
			<div class="text1">
				Error
			</div>
		</div>
	</div>
	<?php
	if ($_SESSION['ValidadoN']==0) {
	}else if($_SESSION['ValidadoN']==1){
		echo "<script>";
		echo "$('#alerta1').slideDown('slow');
						setTimeout(function(){
						$('#alerta1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['ValidadoN']=0;
	}else if($_SESSION['ValidadoN']==3){
		echo "<script>";
		echo "$('#error1').slideDown('slow');
						setTimeout(function(){
						$('#error1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['ValidadoN']=0;
	}
	include("../../php/config.php");
	 ?>
	<header>
		<?php include('../../partes/header-validar-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp" style="margin-top:150px;">
			<h2 >Nutriólogo validado</h2>
			<a id="boton-derecha" href="validar-nutriologo.php"><span class="fa fa-check"></span>&nbsp&nbspValidar</a>
			<div class="line"></div>


			<table class="tabla">
			  <tr>
					<th>ID_Nutriologo</th>
			    <th>Certificado</th>
					<th class="text-eliminar">Validar</th>
			  </tr>
				<?php

					$query = "SELECT * FROM nutriologo WHERE Validado=1";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td><?php echo $row['ID_Nutriologo'] ?></td>
					<td>
					 <img style="width:100px; padding:0; margin:0;"src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Certificado'])?>" alt="">
				 	</td>
			    <td class="cambiar"> <a href="../../php/administrador/validado-nutriologo.php?id=<?php echo $row['ID_Nutriologo']; ?>"><span class="fa fa-times"></span></a></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
