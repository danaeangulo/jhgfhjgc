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
	<title>Daale - Preguntas</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/administrador/tablas.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
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
				Pregunta eliminada
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
	if ($_SESSION['Preguntas']==0) {
	}else if($_SESSION['Preguntas']==1){
		echo "<script>";
		echo "$('#alerta1').slideDown('slow');
						setTimeout(function(){
						$('#alerta1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Preguntas']=0;
	}else if($_SESSION['Preguntas']==2){
		echo "<script>";
		echo "$('#alerta2').slideDown('slow');
						setTimeout(function(){
						$('#alerta2').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Preguntas']=0;
	}else if($_SESSION['Preguntas']==3){
		echo "<script>";
		echo "$('#error1').slideDown('slow');
						setTimeout(function(){
						$('#error1').slideUp('slow');
					}, 3000);";
		echo "</script>";
		$_SESSION['Preguntas']=0;
	}
	 ?>
	<header>
		<?php include('../../partes/header-administrador.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Preguntas</h2>
			<a id="boton-derecha" href="agregar-pregunta.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<table class="tabla">
			  <tr>
					<th>ID_Preguntas</th>
			    <th>Pregunta</th>
					<th class="text-eliminar">Editar</th>
					<th class="text-eliminar">Eliminar</th>
			  </tr>
				<?php
					include("../../php/config.php");
					$query = "SELECT * FROM preguntas";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td><?php echo $row['ID_Preguntas'] ?></td>
	 				<td><?php echo $row['Pregunta'] ?></td>
			    <td class="cambiar"> <a href="editar-pregunta.php?id=<?php echo $row['ID_Preguntas']; ?>"><span class="fa fa-pencil"></span></a></td>
					<td class="eliminar"> <a href="../../php/administrador/eliminar-pregunta.php?id=<?php echo $row['ID_Preguntas']; ?>"><span class="fa fa-trash"></span></a></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
