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
	<title>Daale - Agregar alimento</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
	<link rel="stylesheet" href="../../css/pages/nutriologo/range.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
	<script type="text/javascript">
		function getVals(){
		// Get slider values
		var parent = this.parentNode;
		var slides = parent.getElementsByTagName("input");
			var slide1 = parseFloat( slides[0].value );
			var slide2 = parseFloat( slides[1].value );
		// Neither slider will clip the other, so make sure we determine which is larger
		if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }

		var displayElement = parent.getElementsByClassName("rangeValues")[0];
				displayElement.innerHTML = "$ " + slide1 + "k - $" + slide2 + "k";
		}

		window.onload = function(){
		// Initialize Sliders
		var sliderSections = document.getElementsByClassName("range-slider");
				for( var x = 0; x < sliderSections.length; x++ ){
					var sliders = sliderSections[x].getElementsByTagName("input");
					for( var y = 0; y < sliders.length; y++ ){
						if( sliders[y].type ==="range" ){
							sliders[y].oninput = getVals;
							// Manually trigger event first time to display values
							sliders[y].oninput();
						}
					}
				}
		}
	</script>
</head>
<body>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM nutriologo I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$validado=$row['Validado'];
	 ?>
	<header >
		<?php include('../../partes/header-nutriologo.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Alimento</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás agregar tus alimentos, posteriormente editarlos y manipularlos.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="../../php/nutriologo/agregar-alimento.php?id=<?php echo $row['ID_Nutriologo']; ?>" method="post" enctype="multipart/form-data">
				<h2>Rellenado de formulario:</h2>
				<input  class="pequeño1" type="text" name="nombre" placeholder="Nombre del alimento" required>
				<input class="pequeño2" type="number" name="calorias" placeholder="Calorías" required>

				<div class="text-left">Foto referente al alimento:</div>
				<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" >

				<br>
				<div class="text-left-mini">Cantidad:  </div>
				<div class="text-left-mini">Unidad:  </div>

				<br>

				<input class="mini" type="number" name="cantidad" required>
				<select name="unidad" class="mini2">
					<?php
						$query5 = "SELECT ID_Unidades, Nombre AS NU FROM unidades";
						$resultado5 = $conexion->query($query5);
					?>
					<?php while($row = $resultado5->fetch_assoc()){ ?>
					<option value="<?php echo $row['ID_Unidades']; ?>" require><?php echo $row['NU']; ?></option>
					<?php } ?>
				</select>

				<br><br><br><br>

				<div class="text-left-mini">Proteínas (%):  </div>
				<div class="text-left-mini">Grasas (%):  </div>
				<div class="text-left-mini0">Carbohidratos(%):  </div>

				<br>
				<input class="mini" type="number" name="proteinas" required>
				<input class="mini" type="number" name="grasas" required>
				<input class="mini0" type="number" name="carbohidratos" required>

				<br><br><br><br>

				<input type="submit" value="Agregar" id="boton">

		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
