<?php
session_start();
if (@!$_SESSION['Nombre']) {
	header("Location:../../index.php");
}elseif ($_SESSION['Rol']==1) {
	header("Location:../general/peso.php");
}elseif ($_SESSION['Rol']==2) {
	header("Location:../administrador/general.php");
}elseif ($_SESSION['Rol']==4) {
	header("Location:../nutriologo/dietas.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Daale - Agregar serie</title>
	<link rel="icon" href="../../images/daale.png" type="image/png">
	<link rel="stylesheet" href="../../css/pages/instructor/agregar.css">
	<link rel="stylesheet" href="../../css/font-awesome.css">
  <link rel="stylesheet" href="../../css/partes/footer.css">
  <link rel="stylesheet" href="../../css/partes/header-general.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script type="text/javascript">
		function Mas(){
			document.getElementById("e").style.display="block";
		}
		function Menos(){
			document.getElementById("e").style.display="none";
		}
		function Mostrar_Mas(){
			var e = document.getElementById("e");
			if(e.style.display=="none"){
				Mas();
				document.getElementById("e").value="Quitar ejercicio";
			}else{
				Menos();
				document.getElementById("e").value="Agregar ejercicio";
			}
		}
		function vermas(cuadro, boton){
			if(document.getElementById(cuadro).style.display=="block"){
				document.getElementById(cuadro).style.display="none";
				document.getElementById(boton).innerHTML="Ver más";
			}else{
				document.getElementById(cuadro).style.display="block";
				document.getElementById(boton).innerHTML="Ocultar";
			}

		}
	</script>
</head>
<body>
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM instructor I WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	<header>
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
  <section>
		<div class="caja animated fadeInUp">
			<h2 >Agregar Serie</h2>
			<div class="line"></div>

			<div class="text-left">
				Aquí podrás agregar tus series, posteriormente editarlas y manipularlas.
			</div>
			<div class="text-left"><a href="#">Más información.</a></div>

		<form action="ejercicios.php">

				<h2>Rellenado de formulario:</h2>
				<input  class="pequeño1" type="text" name="nombre" placeholder="Nombre de la serie" required>
				<input class="pequeño2" type="number" name="id" placeholder="Set's" required>

				<div class="text-left">Ejercicio 1</div>
				<select name="ejercicio1" required>
					<?php
						$id_i=$row['ID_Instructor'];
						$query2 = "SELECT Nombre FROM ejercicios WHERE ID_Instructor='$id_i'";
						$resultado2 = $conexion->query($query2);
					 	while($row = $resultado2->fetch_assoc()){
					?>
					<option value="<?php echo $row['Nombre']; ?>" ><?php echo $row['Nombre']; ?></option>
					<?php } ?>
				</select>

				<a id="mostrar1" type="button" onclick="vermas('uno', 'mostrar1')">Ver más</a>
				<div id="uno" style="display:none" >
						<div class="text-left">Ejercicio 2</div>
						<select name="ejercicio2">
							<?php
								$id_i=$row['ID_Instructor'];
								$query3 = "SELECT Nombre FROM ejercicios WHERE ID_Instructor='$id_i'";
								$resultado3 = $conexion->query($query3);
								while($row = $resultado3->fetch_assoc()){
							?>
							<option value="<?php echo $row['Nombre']; ?>" ><?php echo $row['Nombre']; ?></option>
							<?php } ?>
						</select>
						<a id="mostrar2" type="button" onclick="vermas('dos', 'mostrar2')">Ver más</a>
						<div id="dos" style="display:none" >
								<div class="text-left">Ejercicio 3</div>
								<select name="ejercicio3">
									<?php
										$id_i=$row['ID_Instructor'];
										$query4 = "SELECT Nombre FROM ejercicios WHERE ID_Instructor='$id_i'";
										$resultado4 = $conexion->query($query4);
										while($row = $resultado4->fetch_assoc()){
									?>
									<option value="<?php echo $row['Nombre']; ?>" ><?php echo $row['Nombre']; ?></option>
									<?php } ?>
								</select>
								<a id="mostrar3" type="button" onclick="vermas('tres', 'mostrar3')">Ver más</a>
								<div id="tres" style="display:none" >
										<div class="text-left">Ejercicio 4</div>
										<select name="ejercicio4">
											<?php
												$id_i=$row['ID_Instructor'];
												$query4 = "SELECT Nombre FROM ejercicios WHERE ID_Instructor='$id_i'";
												$resultado4 = $conexion->query($query4);
												while($row = $resultado4->fetch_assoc()){
											?>
											<option value="<?php echo $row['Nombre']; ?>" ><?php echo $row['Nombre']; ?></option>
											<?php } ?>
										</select>

								</div>
						</div>
				</div>


				<input type="submit" value="Agregar" id="boton" >
				<div class="text-left">Modifica la información de tu perfil y presiona el botón editar.  </div>
		</form>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
<?php } ?>
</body>
</html>
