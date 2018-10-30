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
	<title>Daale - Seleccionar dieta</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/perfil.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN general G ON G.User=U.ID_User  WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_dieta=$row['Dieta'];
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Selecciona una dieta para continuar</h2>
			<div class="line"></div>
			<div class="text-left">
				Aquí podrás seleccionar la dieta que se adapte mejor a tus propias comodidades.
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
<form style="margin-top:50px;" action="../../php/general/seleccionar-dieta.php" method="post">
		<table class="tabla">
			<tr>
				<th class="arriba-izq">Nombre</th>
				<th class="arriba-izq">Calorías</th>
				<th class="arriba-izq">Personas usándola</th>
				<th class="arriba-izq">Nutriólogo</th>
				<!--
				<th class="arriba-izq">Sexo</th>
				<th class="arriba-izq">Objetivo</th>
			-->
				<th class="text-eliminar">Seleccionar</th>
			</tr>
				<?php
					$query2 = "SELECT D.ID_Dietas, D.ID_Nutriologo, D.Descripcion, D.Nombre AS N, D.Calorias AS Cal, D.Cuerpo, D.Sexo, D.Meta FROM dietas D INNER JOIN cuerpos C WHERE  C.ID_Cuerpos=D.Cuerpo";
					$resultado2 = $conexion->query($query2);
					while($row = $resultado2->fetch_assoc()){
					$dieta=$row['ID_Dietas'];
					$nutriologo=$row['ID_Nutriologo'];
				?>
				<tr>
						<td><?php echo $row['N']; ?></td>
						<td><?php echo $row['Cal']; ?></td>
						<td><?php
							require("../../php/connect_db.php");
							$sql0=("SELECT COUNT(Dieta) FROM general WHERE Dieta='$dieta'");
							$query0=mysqli_query($mysqli,$sql0);
							while($fila0=mysqli_fetch_array($query0)){
							$r=$fila0[0];
							}
							echo $r;

						?></td>
						<td><?php
							$queryN = "SELECT I.ID_Nutriologo, I.Nombre, I.Ap_P, I.Ap_M, I.Validado, U.User FROM nutriologo I INNER JOIN user U INNER JOIN dietas R WHERE R.ID_Nutriologo=I.ID_Nutriologo AND I.ID_Nutriologo='$nutriologo' AND I.User=U.ID_User";
							$resultadoN = $conexion->query($queryN);
							$rowN = $resultadoN->fetch_assoc();
							?>
							<a href="perfil-nutriologo.php?id=<?php echo $nutriologo;?>"><?php
							echo $rowN['User'];
							if ($rowN['Validado']==1) {
									?>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								<?php }
						?></a></td>
						<!-- <?php /*
						<td><?php echo $row['Sexo']; ?></td>
						<td>
								<?php $res=$row['Meta'];
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
						<td class="cambiar">
							<input type="radio" name="radio" value="<?php echo $dieta ?>" required>
						</td>
				</tr>
				<?php } ?>
		</table>
				<input type="submit" value="Continuar" name="submit" id="boton">
				<div class="text-left" style="margin-bottom:30px;">Seleccionar una dieta para continuar.  </div>
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
