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
	<title>Daale - General</title>
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
			<h2 >General</h2>
			<div class="line"></div>
			<table class="tabla">
			  <tr>
					<th>Foto_Perfil</th>
			    <th>ID_G</th>
			    <th>Nombre</th>
					<th>ID_User</th>
					<th>User</th>
			    <th>Fech_Nac&nbsp&nbsp</th>
					<th>Sexo</th>
					<th>Altura</th>
					<th>Peso_Inicial</th>
					<th>Peso_Act</th>
					<th>Peso_Meta</th>
					<th>Cuerpo</th>
					<th>Rutina</th>
					<th>Dieta</th>
			  </tr>
				<?php
					include("../../php/config.php");
					$query = "SELECT *, G.Nombre AS NG, C.Nombre AS NC FROM general AS G INNER JOIN user AS U INNER JOIN cuerpos AS C WHERE G.User=U.ID_User AND G.Tipo_Cuerpo=C.ID_Cuerpos ORDER BY G.ID_General ASC";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td>
					 <img style="width:100px; padding:0; margin:0;"src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Perfil'])?>" alt="">
				 	</td>
					<td><?php echo $row['ID_General'] ?></td>
	 				<td><?php echo $row['NG'] ?></td>
					<td><?php echo $row['ID_User'] ?></td>
	 				<td><?php echo $row['User'] ?></td>
	 				<td><?php echo $row['Fech_Nac'] ?></td>
	 				<td><?php echo $row['Sexo'] ?></td>
	 				<td><?php echo $row['Altura'] ?></td>
	 				<td><?php echo $row['Peso_Inicial'] ?></td>
	 				<td><?php echo $row['Peso_Act'] ?></td>
	 				<td><?php echo $row['Peso_Meta'] ?></td>
	 				<td><?php echo $row['NC'] ?></td>
	 				<td><?php echo $row['Rutina'] ?></td>
	 				<td><?php echo $row['Dieta'] ?></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
