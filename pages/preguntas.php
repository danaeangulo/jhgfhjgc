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
    <script type="text/javascript">
		function clave(_valor){
			document.getElementById('clave').style.visibility=_valor;
		}
  	</script>
  </head>
  <body>
    <?php
    include("../php/config.php");
    require("../php/connect_db.php");
    $id=$_SESSION['usuario'];
     ?>
    <div class="toast error1" id="error1">
   		<div class="toast-contenido">
   			<div class="text1">
   			  Primer respuesta incorrecta
   			</div>
   		</div>
   	</div>
     <div class="toast error2" id="error2">
   		<div class="toast-contenido">
   			<div class="text1">
          Segunda respuesta incorrecta
   			</div>
   		</div>
   	</div>
     <div class="toast error3" id="error3">
   		<div class="toast-contenido">
   			<div class="text1">
   			  Las contraseñas no coinciden
   			</div>
   		</div>
   	</div>
    <div class="toast alerta1" id="alerta1">
  		<div class="toast-contenido">
  			<div class="text1">
  			  Contraseña cambiada
  			</div>
  		</div>
  	</div>
    <div class="modal" id="clave">
  		<div class="modal-contenido">
  			<div class="arriba-editar"><!--modificar-->
  				<div class="izq-titulo">Nueva contraseña</div>
  				<a id="close" class="close2" href="javascript:clave('hidden');"><span class="fa fa-times"></span></a>
  				<div class="line-titulo"></div>
  			</div>
  			<form action="" id="form-clave" method="post">
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
        <script type="text/javascript">
          jQuery(document).on('submit', '#form-clave', function(event){
            event.preventDefault();
            jQuery.ajax({
              url: '../php/nueva-clave.php',
              type: 'POST',
              dataType: 'json',
              data: $(this).serialize(),
              beforeSend: function(){
                  $('.btn-clave').val('Verificando...');
              }
            })
            .done(function(respuesta){
              console.log(respuesta);
              if (!respuesta.error3) {
                //document.getElementById('clave').style.visibility="hidden";
								$('#alerta1').slideDown('slow');
								setTimeout(function(){
										$('#alerta1').slideUp('slow');
								}, 3000);
                location.href = '../index.php';
              } else if (respuesta.error3 == true) {
                $('#error3').slideDown('slow');
                setTimeout(function(){
                    $('#error3').slideUp('slow');
                }, 3000);
              }
              $('.btn-clave').val('Listo');
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
    </div>
    <div class="logo">
      <a href="../index.php">
      <img src="../images/Daale_Blanco.png" alt="">
      </a>
    </div>
          <section>
            <div class="formulario" style="padding-bottom:180px;">
                <form action="" id="preg" method="post">
                  <h2 class="">Recuperar contraseña</h2>
                  <div class="line"></div>
                    <h3 style="width:49%; float:left; margin-right:2%;">Responde ambas preguntas</h3>
                    <h3 style="width:49%; float:left;">Respuestas</h3>
                      <?php
                        $query2 = "SELECT U.Pregunta1, P.Pregunta FROM preguntas P INNER JOIN user U WHERE P.ID_Preguntas=U.Pregunta1 AND U.ID_User='$id'";
                        $resultado2 = $conexion->query($query2);
                        $row2 = $resultado2->fetch_assoc();
                      ?>
                      <input name="pregunta1" value="<?php echo $row2['Pregunta']; ?>" class="pregunta-respuesta" readonly>
                      <input type="text" name="respuesta1" placeholder="" class="respuesta" required>

                      <?php
                        $query3 = "SELECT U.Pregunta2, P.Pregunta FROM preguntas P INNER JOIN user U WHERE P.ID_Preguntas=U.Pregunta2 AND U.ID_User='$id'";
                        $resultado3 = $conexion->query($query3);
                        $row3 = $resultado3->fetch_assoc();
                      ?>
                      <input name="pregunta2" value="<?php echo $row3['Pregunta']; ?>" class="pregunta-respuesta" readonly>

                    <input type="text" name="respuesta2" placeholder="" class="respuesta" required>

                  <input type="submit" style="margin-left:10px;" value="Siguiente" id="mas2" class="btn2">
                  <a href="recuperar.php" id="menos1">Regresar</a>
                </form>
                <script type="text/javascript">
          				jQuery(document).on('submit', '#preg', function(event){
          					event.preventDefault();
          					jQuery.ajax({
          						url: '../php/validar-pregunta.php',
          						type: 'POST',
          						dataType: 'json',
          						data: $(this).serialize(),
          						beforeSend: function(){
          								$('.btn2').val('Verificando...');
          						}
          					})
                    .done(function(respuesta){
                      console.log(respuesta);
                      if (!respuesta.error1 && !respuesta.error2) {
                        document.getElementById('clave').style.visibility='visible';
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
                      $('.btn2').val('Siguiente');
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
