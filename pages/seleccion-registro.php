<?php
session_start();
if (@!$_SESSION['Rol']) {
}else{
    if ($_SESSION['Rol']==1) {
    	header("Location:../pages/general/peso.php");
    }elseif ($_SESSION['Rol']==2) {
    	header("Location:../pages/administrador/general.php");
    }elseif ($_SESSION['Rol']==3) {
    	header("Location:../pages/instructor/rutinas.php");
    }elseif ($_SESSION['Rol']==4) {
    	header("Location:../pages/nutriologo/dietas.php");
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalabe=no, intial-sacle=1, maximun-scale=1, mininum-scale=1">
    <title>Daale - Selección de Registro</title>
  	<link rel="icon" href="../images/daale.png" type="image/png">
    <link href="../css/pages/seleccion-registro.css" rel="stylesheet" type="text/css">
    <link href="../css/partes/footer-fuera.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/animate.css">
  	<link rel="stylesheet" href="../css/font-awesome.css">
    <script src="../js/jquery-3.2.1.js"></script>
  	<script src="../js/main.js"></script>

  </head>
  <body>
    <div class="logo">
      <a href="../index.php">
      <img src="../images/Daale_Blanco.png" alt="">
      </a>
    </div>
          <section>

            <div class="registros animated fadeInUp">
              <h2 class="">Tipos de usuario</h2>
              <div class="line"></div>


              <div class="vertical-menu ">
                <a href="general/registro-general.php" class="active"><span class="fa fa-user icon-menu"></span>&nbsp&nbsp Usuario General</a>
                <a href="nutriologo/registro-nutriologo.php"><span class="fa fa-cutlery icon-menu"></span>&nbsp&nbsp Nutriólogo</a>
                <a href="instructor/registro-instructor.php"><span class="fa fa-wrench icon-menu"></span>&nbsp&nbsp Instructor</a>
              </div>


              <div class="text-center" style="font-weight: bold;">¿No sabes qué usuario eres?</div>
              <div class="text-left" style="text-align:justify;">Cada usuario tiene su uso dentro de la página, Daale te recomienda comparar los usos y objetivos de cada usuario con los tuyos para seleccionar tu tipo de usuario.</div>
              <div class="text-left"><a href="informacion-usuarios.php">Más información.</a></div>
            </div>
          </section>

      <?php include('../partes/footer-fuera.php'); ?>


  </body>
</html>
