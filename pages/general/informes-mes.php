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
	<title>Daale - Informes por mes</title>
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
	<script type="text/javascript">
		function desplegar(_valor){
			document.getElementById('mes').style.visibility=_valor;
		}
	</script>
</head>
<body>

	</div>
	<header >
		<?php include('../../partes/header-general-mes.php'); ?>
	</header>

	<div class="modal" id="mes">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar mes</div>
				<a id="close" class="close2" href="javascript:desplegar('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form>
					<div class="text-left">Número de mes</div>
					<input  type="number" name="dia" value="1" required>
					<div class="text-left">Modifica el mes dentro del rango de 1 al 2.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:desplegar('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>

  <section>
		<div style="margin-top:150px" class="caja animated fadeInUp">
			<h2 >Informes al mes</h2>
			<div class="line"></div>
			<div class="fila1">


				<div class="text-left">
					En esta sección se mostrará el porcentaje de macros consumidos durante las semanas y en sí el total del mes para verificar el buen funcionamiento de los alimentos consumidos de la dieta seleccionada.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">

				<h2>Registros:</h2>
			</div>
			<table class="semana">
				<tr>
				<th class="cuadros">Número de mes</th>
			 	<td class="cuadros">1</td>
				<td class="cambiar"> <a href="javascript:desplegar('visible');" ><span class="fa fa-pencil"></span></a></td>
			 </tr>
			</table>


			<h2>Por mes:</h2>


			<table>
				<tr>
					<th>Proteina (%)</th>
					<td>30%</td>
				</tr>
				<tr>
					<th>Carbohidratos (%)</th>
					<td>40%</td>
				</tr>
				<tr>
					<th>Grasas (%)</th>
					<td>30%</td>
				</tr>
				<tr>
					<th>Total macros (%)</th>
					<td>100%</td>
				</tr>
				<tr>
					<th>Calorías del mes</th>
					<td>14000</td>
				</tr>

			</table>


			<h2>Por semanas:</h2>



			<table class="table-izq">
			  <tr>
			    <th>Semanas</th>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
				</tr>
				<tr>
			 </tr>
				<tr>
			    <th>Proteína (%)</th>
					<td>30%</td>
					<td>30%</td>
					<td>30%</td>
					<td>30%</td>
				</tr>
				<tr>
					<th>Carbohidratos (%)</th>
					<td>40%</td>
					<td>40%</td>
					<td>40%</td>
					<td>40%</td>
				</tr>
				<tr>
					<th>Grasas (%)</th>
					<td>30%</td>
					<td>30%</td>
					<td>30%</td>
					<td>30%</td>
				</tr>
				<tr>
					<th>Total macros (%)</th>
					<td>100%</td>
					<td>100%</td>
					<td>100%</td>
					<td>100%</td>
				</tr>
				<tr>
			    <th>Calorías de la semana</th>
					<td>4000</td>
					<td>4000</td>
					<td>4000</td>
					<td>4000</td>
				</tr>

			</table>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
