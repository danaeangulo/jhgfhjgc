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
<html>
  <head>
    <meta charset="utf-8">
    <title>Daale - Subir foto del certificado</title>
		<link rel="icon" href="../../images/daale.png" type="image/png">
    <link href="../../css/pages/general/registro.css" rel="stylesheet" type="text/css">
    <link href="../../css/partes/footer-fuera.css" rel="stylesheet" type="text/css">
    <link href="../../css/partes/form.css" rel="stylesheet" type="text/css">

    <link href="../../css/partes/foto.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/animate.css">
  	<link rel="stylesheet" href="../../css/font-awesome.css">

  </head>
  <body>
    <section>
      <div class="logo animated flipInX">
        <img src="../../images/Daale_Blanco.png" alt="">
      </div>
        <form class="formulario animated swing" action="../../php/nutriologo/foto-certificado.php" method="post" enctype="multipart/form-data">
		       		<h2 class="animated bounce">Sube una foto de certificado o título</h2>
              <div class="line"></div>
              <div class="text-left">
                Podrás subir una nueva foto en cualquier otro momento.
              </div>
              <input class="file-input" name="imagen" type="file" accept=".png, .jpg, .jpeg, .gif" value="Buscar archivo" required>

              <div class="abajo-botones">
                <input type="submit" value="Continuar" id="boton-listo" style="float:left; width:69%;">
                <div class="cancelar" style="float:left; width:29%; margin-left:2%;">
                  <a  href="dietas.php">Omitir</a>
                </div>
              </div>
              <div class="text-left3">Al omitir tendrás la opción de subir la foto en el apartado de editar perfil.  </div>

  		 </form>
		</section>
    <?php include('../../partes/footer-fuera.php'); ?>
  </body>
</html>
