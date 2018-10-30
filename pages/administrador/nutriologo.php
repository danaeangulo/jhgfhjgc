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
	<title>Daale - Nutriólogo</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/administrador/tablas.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
</head>
<body>
	</div>
	<header>
		<?php include('../../partes/header-administrador.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Nutriólogo</h2>
			<div class="line"></div>
			<table class="tabla">
			  <tr>
					<th>Foto_Perfil</th>
					<th>Foto_Certificado</th>
			    <th>ID_N</th>
			    <th>Nombre</th>
					<th>Ap_P</th>
					<th>Ap_M</th>
					<th>ID_User</th>
					<th>User</th>
					<th>Fech_Nac&nbsp&nbsp</th>
					<th>Sexo</th>
					<th>Correo</th>
					<th>Teléfono</th>
					<th>Validado</th>
			  </tr>
				<?php
					include("../../php/config.php");
					$query = "SELECT * FROM nutriologo N INNER JOIN user U WHERE N.User=U.ID_User";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td>
					 <img style="width:100px; "src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Perfil'])?>" alt="">
				 	</td>
					<td>
					 <img style="width:100px; padding:0; margin:0;"src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Certificado'])?>" alt="">
				 	</td>
					<td><?php echo $row['ID_Nutriologo'] ?></td>
					<td><?php echo $row['Nombre'] ?></td>
					<td><?php echo $row['Ap_P'] ?></td>
					<td><?php echo $row['Ap_M'] ?></td>
					<td><?php echo $row['ID_User'] ?></td>
					<td><?php echo $row['User'] ?></td>
					<td><?php echo $row['Fech_Nac'] ?></td>
					<td><?php echo $row['Sexo'] ?></td>
					<td><?php echo $row['Correo'] ?></td>
					<td><?php echo $row['Telefono'] ?></td>
					<td><?php echo $row['Validado'] ?></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
