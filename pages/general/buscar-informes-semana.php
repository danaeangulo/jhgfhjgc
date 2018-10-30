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
	<title>Daale - Informes por semana</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/general/informes.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/subheader-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link rel="stylesheet" href="../../css/modal.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
</head>
<body>
	<?php
		include("../../php/config.php");
		require("../../php/connect_db.php");
		$fecha=	$_POST['fecha'];
		$dia   = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anio = substr($fecha,0,4);

		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$id_g=$row['ID_General'];
		$dieta=$row['Dieta'];
		if ($dieta==0) {
			header("Location:seleccionar-dieta.php");
		}
	 ?>
	</div>
	<header >
		<?php include('../../partes/header-general-semana.php'); ?>
	</header>

	<div class="modal" id="semana">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar semana</div>
				<a id="close" class="close2" href="#"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form>
					<div class="text-left">Número de semana</div>
					<input  type="number" name="dia" value="1" required>
					<div class="text-left">Modifica la semana dentro del rango de 1 al 10.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="#">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>

  <section>
		<div style="margin-top:150px" class="caja animated fadeInUp">
			<h2 >Informes a la semana</h2>
			<div class="line"></div>
			<div class="fila1">


				<div class="text-left">
					En esta sección se mostrará el porcentaje de macros consumidos durante los días de la semana y en sí el total de la semana para verificar el buen funcionamiento de los alimentos consumidos de la dieta seleccionada.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">

				<h2>Buscar:</h2>
			</div>


			<form action="buscar-informes-semana.php" method="post" style="margin-bottom:30px;">


					<select name="fecha" style="width:49%; margin-right:2%; float:left; height: 40px;">
						<?php
						$query2 = "SELECT * FROM comida C WHERE C.ID_General='$id_g' ORDER BY C.Fecha DESC";
						$resultado2 = $conexion->query($query2);
						while($row2 = $resultado2->fetch_assoc()){
						 ?>
						<option value="<?php echo $row2['Fecha']; ?>" require><?php echo $row2['Fecha']; ?></option>
					<?php } ?>
					</select>
				<input type="submit" value="Ver semana de la fecha seleccionada" id="boton-ver">
			</form>


			<?php
			$week = date('W',  mktime(0,0,0,$mes,$dia,$anio));

			for($i=-2; $i<5; $i++){
			    $arreglo[$i]= date('Y-m-d', strtotime('01/01 +' . ($week - 1) . ' weeks first day +' . $i . ' day')) . '<br />';
			}
			 ?>

			 <h2>Por días:</h2>



 			<table class="table-izq">
 			  <tr>
 			    <th>Días</th>
 					<td>Domingo</td>
 					<td>Lunes</td>
 					<td>Martes</td>
 					<td>Miercoles</td>
 					<td>Jueves</td>
 					<td>Viernes</td>
 					<td>Sábado</td>

 				</tr>
 				<tr>
 				 <th>Fechas</th>
 				<?php
 				for($i=-2; $i<5; $i++){
 					?><td style="font-size:12px; margin-right:0px; margin-left:-15px; text-align:left;"><?php
 				    echo date('M-d', strtotime('01/01 +' . ($week - 1) . ' weeks first day +' . $i . ' day')) . '<br />';

 					?></td><?php
 				} ?>

 			 </tr>
 				<tr>
 			 </tr>
 				<tr>
 			    <th>Proteína (%)</th>
 					<?php
 						for($i=-2; $i<5; $i++){
 							$query2 = "SELECT P_Proteinas FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
 							$resultado2 = $conexion->query($query2);
 							$row2 = $resultado2->fetch_assoc();
 							?><td><?php
 							echo $row2['P_Proteinas'];
 							?></td><?php
 						}
 					 ?>
 				</tr>
 				<tr>
 					<th>Carbohidratos (%)</th>
 					<?php
 						for($i=-2; $i<5; $i++){
 							$queryC = "SELECT P_Carbohidratos FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
 							$resultadoC = $conexion->query($queryC);
 							$rowC = $resultadoC->fetch_assoc();
 							?><td><?php
 							echo $rowC['P_Carbohidratos'];
 							?></td><?php
 						}
 					 ?>
 				</tr>
 				<tr>
 					<th>Grasas (%)</th>
 					<?php
 						for($i=-2; $i<5; $i++){
 							$queryG = "SELECT P_Grasas FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
 							$resultadoG = $conexion->query($queryG);
 							$rowG = $resultadoG->fetch_assoc();
 							?><td><?php
 							echo $rowG['P_Grasas'];
 							?></td><?php
 						}
 					 ?>
 				</tr>
 				<tr>
 					<th>Situación</th>
 					<?php
 						for($i=-2; $i<5; $i++){
 							$queryS = "SELECT Situacion FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
 							$resultadoS = $conexion->query($queryS);
 							$rowS = $resultadoS->fetch_assoc();
 							?><td><?php
 							echo $rowS['Situacion'];
 							?></td><?php
 						}
 					 ?>
 				</tr>
 				<tr>
 			    <th>Calorías del día</th>
 					<?php
						$Ca=0;
 						for($i=-2; $i<5; $i++){
 							$queryCa = "SELECT Calorias FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
 							$resultadoCa = $conexion->query($queryCa);
 							$rowCa = $resultadoCa->fetch_assoc();
							if ($rowCa['Calorias']!=0) {
								$Ca=$Ca+$rowCa['Calorias'];
							}
 							?><td><?php
 							echo $rowCa['Calorias'];
 							?></td><?php
 						}

 					 ?>
 				</tr>

 			</table>
			<h2>Por semana:</h2>
			<table>
				<?php
					$n_p=0;
					$p_p=0;
					$n_c=0;
					$p_c=0;
					$n_g=0;
					$p_g=0;
					for($i=-2; $i<5; $i++){
						$queryT = "SELECT P_Proteinas, P_Carbohidratos, P_Grasas FROM comida WHERE Fecha='$arreglo[$i]' AND ID_General='$id_g'";
						$resultadoT = $conexion->query($queryT);
						$rowT = $resultadoT->fetch_assoc();
						if ($rowT['P_Proteinas']!=0 || $rowT['P_Carbohidratos']!=0 || $rowT['P_Grasas']!=0) {
							$n_p= $n_p+1;
							$p_p= $p_p+$rowT['P_Proteinas'];
							$n_c= $n_c+1;
							$p_c= $p_c+$rowT['P_Carbohidratos'];
							$n_g= $n_g+1;
							$p_g= $p_g+$rowT['P_Grasas'];
						}
					}
					if ($n_p!=0 || $n_c!=0 || $n_p!=0) {
						$p_p=($p_p/$n_p);
						$p_c=($p_c/$n_c);
						$p_g=($p_g/$n_g);
					}

				 ?>
				<tr>
					<th>Proteina (%)</th>
					<td><?php echo $p_p ?>%</td>
				</tr>
				<tr>
					<th>Carbohidratos (%)</th>
					<td><?php echo $p_c ?>%</td>
				</tr>
				<tr>
					<th>Grasas (%)</th>
					<td><?php echo $p_g ?>%</td>
				</tr>
				<tr>
					<th>Total macros (%)</th>
					<td><?php
						$total= $p_p+$p_c+$p_g;
						echo $total;
					 ?>%</td>
				</tr>
				<tr>
					<th>Calorías de la semana</th>
					<td><?php echo $Ca ?></td>
				</tr>

			</table>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
