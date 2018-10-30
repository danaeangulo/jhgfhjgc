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
	<link rel="stylesheet" href="../../css/toast.css">
	<script src="../../js/jquery-3.2.1.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/js9.js"></script>
	<script type="text/javascript">
	function nombre(_valor){
		document.getElementById('nombre').style.visibility=_valor;
	}
	function fecha(_valor){
		document.getElementById('fecha').style.visibility=_valor;
	}
	function altura(_valor){
		document.getElementById('altura').style.visibility=_valor;
	}
	function pesoactual(_valor){
		document.getElementById('peso-actual').style.visibility=_valor;
	}
	function pesometa(_valor){
		document.getElementById('peso-meta').style.visibility=_valor;
	}
	function nombreusuario(_valor){
		document.getElementById('nombre-usuario').style.visibility=_valor;
	}
	function clave(_valor){
		document.getElementById('clave').style.visibility=_valor;
	}
	function fotoperfil(_valor){
		document.getElementById('foto-perfil').style.visibility=_valor;
	}
	</script>
</head>
<body>
	<div class="toast alerta1" id="alerta1">
		<div class="toast-contenido">
			<div class="text1">
				Datos guardados
			</div>
		</div>
	</div>
	<?php
		if($_REQUEST['var']==1){
			echo "<script>";
			echo "$('#alerta1').slideDown('slow');
							setTimeout(function(){
							$('#alerta1').slideUp('slow');
						}, 3000);";
			echo "</script>";
		}
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM general G INNER JOIN user U ON G.User= U.ID_User WHERE G.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
	 ?>
	<header >
		<?php include('../../partes/header-general.php'); ?>
	</header>

	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar nombre</div>
				<a id="close" class="close2" href="javascript:nombre('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-nombre.php" method="post">
					<div class="text-left">Nombre</div>
					<input  type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" required>
					<div class="text-left">Modifica tu nombre y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:nombre('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="fecha">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar fecha de nacimiento</div>
				<a id="close" class="close2" href="javascript:fecha('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-fecha.php" method="post">
					<div class="text-left">Fecha de nacimiento</div>
					<input  type="date" name="fecha" value="<?php echo $row['Fech_Nac']; ?>" required>
					<div class="text-left">Modifica tu fecha de nacimiento y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:fecha('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="altura">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar altura</div>
				<a id="close" class="close2" href="javascript:altura('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-altura.php" method="post">
					<div class="text-left">Altura</div>
					<input  type="float" name="altura" value="<?php echo $row['Altura']; ?>" required>
					<div class="text-left">Modifica tu altura y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:altura('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="peso-actual">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar peso actual</div>
				<a id="close" class="close2" href="javascript:pesoactual('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-pesoact.php" method="post">
					<div class="text-left">Peso actual</div>
					<input  type="float" name="peso_act" value="<?php echo $row['Peso_Act']; ?>" required>
					<div class="text-left">Modifica tu peso actual y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:pesoactual('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="peso-meta">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar peso meta</div>
				<a id="close" class="close2" href="javascript:pesometa('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-pesometa.php" method="post">
					<div class="text-left">Peso meta</div>
					<input  type="float" name="peso_meta" value="<?php echo $row['Peso_Meta']; ?>" required>
					<div class="text-left">Modifica tu peso meta y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:pesometa('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="nombre-usuario">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar nombre de usuario</div>
				<a id="close" class="close2" href="javascript:nombreusuario('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-username.php" method="post">
					<div class="text-left">Nombre de usuario</div>
					<input  type="text" name="user" value="<?php echo $row['User']; ?>" required>
					<div class="text-left">Modifica tu nombre de usuario y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:nombreusuario('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="clave">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar contraseña</div>
				<a id="close" class="close2" href="javascript:clave('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-clave.php" method="post">
					<div class="text-left">Actual</div>
					<input  type="password" name="rpass_act" placeholder="Contraseña actual" required>

					<div class="text-left">Nueva</div>
					<input  type="password" name="pass" placeholder="Contraseña nueva" required>
					<div class="text-left">Verificar</div>
					<input  type="password" name="rpass" placeholder="Confirmar contraseña nueva" required>
					<div class="text-left">Asegurate de que las contraseñas coincidan y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:clave('hidden');">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	<div class="modal" id="foto-perfil">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar foto de perfil</div>
				<a id="close" class="close2" href="javascript:fotoperfil('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/general/cambiar-foto-perfil.php" method="post" enctype="multipart/form-data">
					<div class="text-left">Seleccionar foto de perfil</div>
					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

					<div class="text-left">Modifica tu foto de perfil y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:fotoperfil('hidden');">Cancelar</a>
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
						<div class="h2" style="margin-bottom:35px;">
							Foto de perfil:
						</div>
						<img src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Perfil'])?>" alt="" style="margin-top:-20px;">
						<a href="javascript:fotoperfil('visible');" class="registrar1"> <span class="fa fa-camera"></span>&nbsp Actualizar foto</a>

					</div>
				</form>

				<div class="informacion-perfil2">

					<div class="h2">
						Información de usuario:
					</div>
					<table class="cuenta">
						<tr>
							<th>Nombre</th>
							<td><?php echo $row['Nombre']; ?></td>
							<td class="cambiar"> <a href="javascript:nombre('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Fecha de nacimiento</th>
							<td><?php echo $row['Fech_Nac']; ?></td>
							<td class="cambiar"> <a href="javascript:fecha('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Altura (cm)</th>
							<td><?php echo $row['Altura']; ?></td>
							<td class="cambiar"> <a href="javascript:altura('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Peso actual (kg)</th>
							<td><?php echo $row['Peso_Act']; ?></td>
							<td class="cambiar"> <a href="javascript:pesoactual('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Peso meta (kg)</th>
							<td><?php echo $row['Peso_Meta']; ?></td>
							<td class="cambiar"> <a href="javascript:pesometa('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
					</table>

			</div>
			<div class="informacion-perfil2">

				<div class="h2">
					Información de cuenta:
				</div>
					<table class="cuenta">
					<tr>
						<th>Nombre de usuario</th>
						<td><?php echo $row['User']; ?></td>
						<td class="cambiar"> <a href="javascript:nombreusuario('visible');"><span class="fa fa-pencil"></span></a></td>
					</tr>
					<tr>
						<th>Contraseña</th>
						<td>****</td>
						<td class="cambiar"> <a href="javascript:clave('visible');"><span class="fa fa-pencil"></span></a></td>

					</tr>
				</table>

			</div>
			<div class="text-right">Manipula la información de tu perfil y cuenta.</div>
			<div class="text-right"><a href="#">Más información.</a></div>
	</div>
	<div class="h2">
		Información de avances:
	</div>
		<table>
			<tr>
				<th>Peso inicial (kg)</th>
				<th>Peso actual (kg)</th>
				<th>Diferencia de peso (kg)</th>
				<th>Peso a alcanzar (kg)</th>
				<th>Peso restante (kg)</th>
			</tr>
			<tr>
				<td style="text-align:center;"><?php echo $row['Peso_Inicial']; ?></td>
				<td style="text-align:center;"><?php echo $row['Peso_Act']; ?></td>
				<td style="text-align:center;">
					<?php
					$inicial=$row['Peso_Inicial'];
					$actual= $row['Peso_Act'];
					$diferencia=$actual-$inicial;
					echo $diferencia;
					?>
				</td>
				<td style="text-align:center;"><?php echo $row['Peso_Meta']; ?></td>
				<td style="text-align:center;">
					<?php
						$actual= $row['Peso_Act'];
						$meta=$row['Peso_Meta'];
						$restante=$meta-$actual;
						echo $restante;
					 ?>
				</td>
			</tr>
		</table>
		<div class="text-left">Puedes esitar la información de las dos primeras tablas mediante el botón que se encuentra en la parte superior derecha de la página.</div>
		<div class="text-left"><a href="#">Más información.</a></div>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
	<?php
		}
	 ?>
</body>
</html>
