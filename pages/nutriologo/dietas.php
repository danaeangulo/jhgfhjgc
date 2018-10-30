<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
}elseif ($_SESSION['Rol']==2) {
	header("Location:../administrador/general.php");
}elseif ($_SESSION['Rol']==3) {
	header("Location:../instructor/rutinas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Dietas</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/ejercicios.css">
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
				Dieta eliminada
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
		if ($_SESSION['Dieta']==0) {
		}else if ($_SESSION['Dieta']==1) {
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Dieta']=0;
		}else if ($_SESSION['Dieta']==2) {
			echo "<script>";
			echo "$('#error1').slideDown('slow');
							setTimeout(function(){
							$('#error1').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Dieta']=0;
		}else if ($_SESSION['Dieta']==3) {
			echo "<script>";
			echo "$('#alerta2').slideDown('slow');
							setTimeout(function(){
							$('#alerta2').slideUp('slow');
						}, 3000);";
			echo "</script>";
			$_SESSION['Dieta']=0;
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM user U INNER JOIN nutriologo N ON N.User=U.ID_User  WHERE N.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_nutriologo=$row['ID_Nutriologo'];
		$validado=$row['Validado'];
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Dietas</h2>
			<a id="boton-derecha" href="agregar-dieta.php"><span class="fa fa-plus"></span>&nbsp&nbspAgregar</a>
			<div class="line"></div>
			<div class="fila1">
				<div class="text-left">
					Las dietas agregadas no podrán ser vistas ni utilizadas por otros nutriólogos.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">
			</div>
			<?php
			require("../../php/connect_db.php");
			$sql0=("SELECT COUNT(ID_Dietas) FROM dietas WHERE ID_Nutriologo='$id_nutriologo'");
			$query0=mysqli_query($mysqli,$sql0);
			while($fila0=mysqli_fetch_array($query0)){
			$r=$fila0[0];
			}
			if ($r!=0) {
			 ?>
			<table class="tabla">
				<tr>
				 	<th>Nombre</th>
					<th>Calorías</th>
					<th class="desaparece">Sexo</th>
					<th class="desaparece">Objetivo</th>
					<th>Alimentos</th>
					<th>Recetas</th>
					<th class="text-eliminar">Editar</th>
					<th class="text-eliminar">Eliminar</th>
				</tr>

					<?php
						$id_nutriologo=$row['ID_Nutriologo'];
						$query2 = "SELECT D.ID_Dietas, D.Descripcion, D.Nombre AS N, D.Calorias AS Cal, D.Cuerpo, D.Sexo, D.Meta FROM dietas D  INNER JOIN cuerpos C WHERE D.ID_Nutriologo='$id_nutriologo' AND  C.ID_Cuerpos=D.Cuerpo";
						$resultado2 = $conexion->query($query2);
						while($row = $resultado2->fetch_assoc()){
						$dieta=$row['ID_Dietas'];
					?>
				  <tr>

							<td><?php echo $row['N']; ?></td>
					    <td class="desaparece"><?php echo $row['Cal']; ?></td>
					    <td class="desaparece"><?php echo $row['Sexo']; ?></td>
					    <td style="padding-left:15px;">
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
				    	<td><?php
							$query3=("SELECT A.Nombre FROM conjuntora C INNER JOIN alimentos A WHERE A.ID_Nutriologo='$id_nutriologo' AND  C.ID_Dietas='$dieta'  AND C.ID_Alimentos=A.ID_Alimentos");
							$resultado3 = $conexion->query($query3);
							while($row3 = $resultado3->fetch_assoc()){
							echo $row3['Nombre'];
							?>,
							<?php
							}?>
							</td>
							<td>
								<?php
								$query3=("SELECT A.Nombre FROM conjuntor C INNER JOIN recetas A WHERE A.ID_Nutriologo='$id_nutriologo' AND  C.ID_Dietas='$dieta'  AND C.ID_Recetas=A.ID_Recetas");
								$resultado3 = $conexion->query($query3);
								while($row3 = $resultado3->fetch_assoc()){
								echo $row3['Nombre'];
								?>,
								<?php
							}?>
							</td>
						<td class="cambiar"> <a href="editar-dieta.php?id=<?php echo $row['ID_Dietas']; ?>"><span class="fa fa-pencil"></span></a></td>
						<td class="eliminar"> <a href="../../php/nutriologo/eliminar-dieta.php?id=<?php echo $row['ID_Dietas']; ?>"><span class="fa fa-trash"></span></a></td>
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
