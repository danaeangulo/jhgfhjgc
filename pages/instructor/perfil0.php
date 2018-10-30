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
		function nombre(_valor){
			document.getElementById('nombre').style.visibility=_valor;
		}
		function fecha(_valor){
			document.getElementById('fecha').style.visibility=_valor;
		}
		function correo(_valor){
			document.getElementById('correo').style.visibility=_valor;
		}
		function nombreusuario(_valor){
			document.getElementById('nombre-usuario').style.visibility=_valor;
		}
		function telefono(_valor){
			document.getElementById('telefono').style.visibility=_valor;
		}
		function fotocertificado(_valor){
			document.getElementById('foto-certificado').style.visibility=_valor;
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
	<?php
		include("../../php/config.php");
		$user=$_SESSION['ID_User'];
		$query = "SELECT * FROM instructor I INNER JOIN user U ON I.User=U.ID_User WHERE I.User='$user'";
		$resultado = $conexion->query($query);
		while($row = $resultado->fetch_assoc()){
		$validado=$row['Validado'];
		$id_instructor=$row['ID_Instructor'];
	 ?>
	<header >
		<?php include('../../partes/header-instructor.php'); ?>
	</header>
	<div class="modal" id="nombre">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar nombre</div>
				<a id="close" class="close2" href="javascript:nombre('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/instructor/cambiar-nombre.php" method="post">
					<div class="text-left">Nombre</div>
					<input  type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" required>
					<div class="text-left">Apellido Paterno</div>
					<input  type="text" name="ap_p" value="<?php echo $row['Ap_P']; ?>" required>
					<div class="text-left">Apellido Materno</div>
					<input  type="text" name="ap_m" value="<?php echo $row['Ap_M']; ?>" required>
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
			<form action="../../php/instructor/cambiar-fecha.php" method="post">
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
	<div class="modal" id="correo">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar correo electrónico</div>
				<a id="close" class="close2" href="javascript:correo('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/instructor/cambiar-correo.php" method="post">
					<div class="text-left">Correo electrónico</div>
					<input  type="text" name="correo" value="<?php echo $row['Correo']; ?>" required>
					<div class="text-left">Modifica tu correo electrónico y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:correo('hidden');">Cancelar</a>
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
			<form action="../../php/instructor/cambiar-username.php" method="post">
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
			<form action="../../php/instructor/cambiar-clave.php" method="post">
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
	<div class="modal" id="telefono">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar teléfono</div>
				<a id="close" class="close2" href="javascript:telefono('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/instructor/cambiar-telefono.php" method="post">
					<div class="text-left">Teléfono</div>
					<input  type="tel" name="telefono" value="<?php echo $row['Telefono']; ?>" required>
					<div class="text-left">Modifica tu peso meta y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:telefono('hidden');">Cancelar</a>
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
			<form action="../../php/instructor/cambiar-foto-perfil.php" method="post" enctype="multipart/form-data">
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
	<div class="modal" id="foto-certificado">
		<div class="modal-contenido">
			<div class="arriba-editar"><!--modificar-->
				<div class="izq-titulo">Editar foto de certificado</div>
				<a id="close" class="close2" href="javascript:fotocertificado('hidden');"><span class="fa fa-times"></span></a>
				<div class="line-titulo"></div>
			</div>
			<form action="../../php/instructor/cambiar-foto-certificado.php" method="post" enctype="multipart/form-data">
					<div class="text-left">Seleccionar foto de certificado</div>
					<input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

					<div class="text-left">Modifica tu foto de certificado y presiona listo para guardar los cambios.  </div>
					<div class="abajo-botones">
						<input type="submit" value="Listo" id="boton-listo">
						<div id="close" class="cancelar">
							<a  href="javascript:fotocertificado('hidden');">Cancelar</a>
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
						<div class="h2" style=" margin-bottom:35px;">
							Foto de perfil:
						</div>
						<img src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Perfil'])?>" alt="" style="margin-top:-20px;">
						<a href="javascript:fotoperfil('visible');" class="registrar1"> <span class="fa fa-camera"></span>&nbsp Actualizar foto</a>
						<div class="h2" style="margin-top:20px; margin-bottom:35px;">
							Certificado:
						</div>
						<img src="data:image/jpg;base64, <?php echo base64_encode($row['Foto_Certificado'])?>" alt="" style="margin-top:-20px;">
						<a href="javascript:fotocertificado('visible');" class="registrar1" > <span class="fa fa-camera"></span>&nbsp Subir certificado</a>
					</div>
				</form>

				<div class="informacion-perfil2">

					<div class="h2">
						Información de usuario:
					</div>
					<table class="cuenta">
						<tr>
							<th>Nombre</th>
							<td>
								<?php echo $row['Nombre'];?>&nbsp;<?php echo $row['Ap_P']; ?>&nbsp;
								<?php echo $row['Ap_M']; ?>&nbsp;
								<?php
									if ($validado==1) {
									?>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								<?php } ?>





							</td>
							<td class="cambiar"> <a href="javascript:nombre('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Fecha de nacimiento</th>
							<td><?php echo $row['Fech_Nac']; ?></td>
							<td class="cambiar"> <a href="javascript:fecha('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Correo electrónico</th>
							<td><?php echo $row['Correo']; ?></td>
							<td class="cambiar"> <a href="javascript:correo('visible');"><span class="fa fa-pencil"></span></a></td>
						</tr>
						<tr>
							<th>Teléfono</th>
							<td><?php echo $row['Telefono']; ?></td>
							<td class="cambiar"> <a href="javascript:telefono('visible');"><span class="fa fa-pencil"></span></a></td>
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
						<td>
							<?php echo $row['User']; ?>
							<?php
								if ($validado==1) {
								?>
								<i class="fa fa-check-circle" aria-hidden="true"></i>
							<?php } ?>
						</td>
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
		Cantidad de aspectos subidos:
	</div>
		<table>
			<tr>
				<th>Rutinas</th>
				<th>Series</th>
				<th>Ejercicios</th>
			</tr>
			<tr>
				<?php
				require("../../php/connect_db.php");
				$sql0=("SELECT COUNT(ID_Rutinas) FROM rutinas WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$r=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Series) FROM series WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$s=$fila0[0];
				}
				$sql0=("SELECT COUNT(ID_Ejercicios) FROM ejercicios WHERE ID_Instructor='$id_instructor'");
				$query0=mysqli_query($mysqli,$sql0);
				while($fila0=mysqli_fetch_array($query0)){
				$e=$fila0[0];
				}
				 ?>
				<td style="text-align:center;"><?php echo $r; ?></td>
				<td style="text-align:center;"><?php echo $s; ?></td>
				<td style="text-align:center;"><?php echo $e; ?></td>
			</tr>
		</table>
		</div>
  </section>
	<?php include('../../partes/footer.php'); ?>
	<?php
		}
	 ?>
</body>
</html>
