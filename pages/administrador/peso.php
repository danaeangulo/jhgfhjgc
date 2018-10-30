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
	<title>Daale - Peso</title>
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
			<h2 >Peso</h2>
			<div class="line"></div>
			<table class="tabla">
			  <tr>
			    <th>ID_Peso</th>
			    <th>P_Anterior</th>
					<th>P_Nuevo</th>
					<th>Fecha</th>
			    <th>Hora</th>
					<th>Resulatado</th>
					<th>ID_G</th>
					<th>Nombre</th>
					<th>ID_User</th>
					<th>User</th>
			  </tr>
				<?php
					include("../../php/config.php");
					$query = "SELECT *, G.Nombre AS NG FROM peso P INNER JOIN general G INNER JOIN user U  WHERE P.ID_General=G.ID_General AND G.User=U.ID_User";
					$resultado = $conexion->query($query);
					while($row = $resultado->fetch_assoc()){
				 ?>
			  <tr>
					<td><?php echo $row['ID_Peso'] ?></td>
					<td><?php echo $row['P_Anterior'] ?></td>
					<td><?php echo $row['P_Nuevo'] ?></td>
					<td><?php echo $row['Fecha'] ?></td>
					<td><?php echo $row['Hora'] ?></td>
					<td><?php echo $row['Resultado'] ?></td>
					<td><?php echo $row['ID_General'] ?></td>
	 				<td><?php echo $row['NG'] ?></td>
					<td><?php echo $row['ID_User'] ?></td>
	 				<td><?php echo $row['User'] ?></td>
			  </tr>
				<?php } ?>
			</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
