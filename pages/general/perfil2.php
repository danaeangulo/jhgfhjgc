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
	<title>Daale - Perfil</title>
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
	<script type="text/javascript">
		$(document).ready(function () {
			$('#close').click(function() {
				$('#modal').fadeOut(500);
			});
			$('#cambiar').click(function() {
				$('#modal').fadeIn(500);
			});
		})
	</script>
</head>
<body>

	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>
	<div class="modal" id="modal">
		<div class="modal-contenido">
			<div class=""><!--MODIFICAR contenedoR position: relative;-->
				<h2>titulo</h2>
				<a id="close" href="#"><span class="fa fa-times"></span></a>
			</div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>

	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--MODIFICAR contenedoR position: relative;-->
				<div class="izq-titulo">Editar nombre</div>
				<a id="close" class="close2" href="#"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form>
					<div class="text-left">Nombre</div>
					<input  type="text" name="nombre" placeholder="Nombre" required>
					<div class="text-left">Modifica tu nombre y presiona listo para guardar los cambios.  </div>
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
		<div class="caja animated fadeInUp">
			<h2 >Perfil</h2>
			<a id="boton-derecha" href="editar-perfil.php"><span class="fa fa-pencil"></span>&nbsp&nbspEditar</a>
			<div class="line"></div>
			<div class="fila1">
				<form>
					<div class="foto-perfil">
						<img src="../../images/dan1.jpg" alt="">
						<a href="#" class="registrar1"> <span class="fa fa-camera"></span>&nbsp Cambiar foto</a>
					</div>
				</form>
				<div class="informacion-perfil">

					<div class="desc">
						Nombre:
					</div>
					<div class="info">
						Dan
					</div>
					<div class="desc">
						Nombre de usuario:
					</div>
					<div class="info">
						danaeangulo
					</div>
					<div class="desc">
						Edad:
					</div>
					<div class="info">
						18
					</div>
					<div class="desc">
						Altura:
					</div>
					<div class="info">
						178 cm
					</div>
					<div class="desc">
						Peso:
					</div>
					<div class="info">
						79.21 kg
					</div>
			</div>
			<div class="informacion-peso">
					<div class="desc">
						Peso inicial:
					</div>
					<div class="info">
						70.1 kg
					</div>
					<div class="desc">
						Peso actual:
					</div>
					<div class="info">
						79.21 kg
					</div>
					<div class="desc">
						Diferencia de peso:
					</div>
					<div class="info">
						8.7 kg
					</div>
					<div class="desc">
						Peso a alcanzar:
					</div>
					<div class="info">
						85 kg
					</div>

					<div class="desc">
						Peso restante:
					</div>
					<div class="info">
						5.79 kg
					</div>
				</div>

			</div>
			<div class="fila1">

				<div class="text-left">
					Manipula la información de tu perfil y cuenta.
				</div>
				<div class="text-left"><a href="#">Más información.</a></div>
			</div>
			<div class="fila1">

				<h2>Información de usuario:</h2>
			</div>
			<table class="cuenta">
				<tr>
					<th>Nombre</th>
					<td>Dan</td>
					<td class="cambiar"> <a href="#nombre"><span class="fa fa-pencil"></span></a></td>
				</tr>
				<tr>
					<th>Fecha de nacimiento</th>
					<td>1999-08-02</td>
					<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>
				</tr>
				<tr>
					<th>Altura (cm)</th>
					<td>178</td>
					<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>
				</tr>
			  <tr>
			    <th>Peso actual (kg)</th>
					<td>79.21</td>
					<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>
			  </tr>
			  <tr>
					<th>Peso meta (kg)</th>
			    <td>85</td>
					<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>
			  </tr>
			</table>

			<h2>Información de cuenta:</h2>
	<table class="cuenta">

			<tr>
				<th>Nombre de usuario</th>
				<td>danaeangulo</td>
				<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>
			</tr>
			<tr>
				<th>Contraseña</th>
				<td></td>
				<td class="cambiar"> <a href="#"><span class="fa fa-pencil"></span></a></td>

			</tr>
		</table>
		<table>
			<tr>
				<th>Nombre</th>
				<th>Fecha de nacimiento</th>
				<th>Altura (cm)</th>
				<th>Peso actual (kg)</th>
				<th>Peso meta (kg)</th>
				<th>Editar</th>
			</tr>
			<tr>
				<td>Dan</td>
				<td>1999-08-02</td>
				<td>178</td>
				<td>79.21</td>
				<td>85</td>
				<td id="cambiar" class="cambiar"> <a href="#modal"><span class="fa fa-pencil"></span></a></td>
			</tr>
		</table>

		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
</body>
</html>
