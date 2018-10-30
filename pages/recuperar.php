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
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Daale - Recuperar contraseña</title>
  	<link rel="icon" href="../images/daale.png" type="image/png">
    <link href="../css/partes/footer-fuera.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/pages/general/registro.css">
  	<link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/toast.css">
  	<link rel="stylesheet" href="../css/modal.css">
    <script src="../js/jquery-3.2.1.js"></script>
  	<script src="../js/main.js"></script>
  </head>
  <body>
    <?php
    include("../php/config.php");
    require("../php/connect_db.php");
     ?>
    <div class="toast error1" id="error1">
  		<div class="toast-contenido">
  			<div class="text1">
  			  El usuario no existe
  			</div>
  		</div>
  	</div>
    <div class="toast error2" id="error2">
  		<div class="toast-contenido">
  			<div class="text1">
  			  No es tu usuario
  			</div>
  		</div>
  	</div>
    <div class="toast error3" id="error3">
  		<div class="toast-contenido">
  			<div class="text1">
  			  Respuesta incorrecta
  			</div>
  		</div>
  	</div>
    <div class="logo">
      <a href="../index.php">
      <img src="../images/Daale_Blanco.png" alt="">
      </a>
    </div>
          <section>
            <div class="formulario">

              <form action="" id="buscar" method="post">
                <h2 class="">Recuperar contraseña</h2>
                <div class="line"></div>
                <div id="sig">
                  <div class="text-left">Ingresa tu nombre de usuario para continuar.</div>
                  <input type="text" name="mail" placeholder="Usuario" required>
                </div>
                <input type="submit" value="Siguiente" id="mas1" class="btn">
              </form>
              <script type="text/javascript">
        				jQuery(document).on('submit', '#buscar', function(event){
        					event.preventDefault();
        					jQuery.ajax({
        						url: '../php/buscar-usuario.php',
        						type: 'POST',
        						dataType: 'json',
        						data: $(this).serialize(),
        						beforeSend: function(){
        								$('.btn').val('Verificando...');
        						}
        					})
                  .done(function(respuesta){
                    console.log(respuesta);
                    if (!respuesta.error1 && !respuesta.error2) {
                      if (respuesta.rol == 1) {
                        location.href = 'preguntas-general.php';
                      }else{
                        location.href = 'preguntas.php';
                      }
                    } else if (respuesta.error1 == true) {
                      $('#error1').slideDown('slow');
                      setTimeout(function(){
                          $('#error1').slideUp('slow');
                      }, 3000);
                    }else if (respuesta.error2 == true) {
                      $('#error2').slideDown('slow');
                      setTimeout(function(){
                          $('#error2').slideUp('slow');
                      }, 3000);
                    }
                    $('.btn').val('Siguiente');
                  })
                  .fail(function(resp){
                    console.log(resp);
                  })
                  .always(function(respuesta){
                    console.log("complete");
                  });
                });
              </script>
            </div>
          </section>
      <?php include('../partes/footer-fuera.php'); ?>
  </body>
</html>
