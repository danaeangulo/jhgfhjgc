<?php
session_start();
if (@!$_SESSION['Rol']) {
}else{
    if ($_SESSION['Rol']==1) {
    	header("Location:../../pages/general/peso.php");
    }elseif ($_SESSION['Rol']==2) {
    	header("Location:../../pages/administrador/general.php");
    }elseif ($_SESSION['Rol']==3) {
    	header("Location:../../pages/instructor/rutinas.php");
    }elseif ($_SESSION['Rol']==4) {
    	header("Location:../../pages/nutriologo/dietas.php");
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalabe=no, intial-sacle=1, maximun-scale=1, mininum-scale=1">
    <title>Daale - Registro Nutriólogo</title>
  	<link rel="icon" href="../../images/daale.png" type="image/png">
    <link href="../../css/pages/general/registro.css" rel="stylesheet" type="text/css">
    <link href="../../css/partes/footer-fuera.css" rel="stylesheet" type="text/css">
    <link href="../../css/partes/form.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/animate.css">
  	<link rel="stylesheet" href="../../css/font-awesome.css">
  	<link rel="stylesheet" href="../../css/modal.css">
    <link rel="stylesheet" href="../../css/toast.css">
  	<script src="../../js/jquery-3.2.1.js"></script>
  	<script src="../../js/main.js"></script>
  	<script src="../../js/js9.js"></script>

  </head>
  <body>
    <div class="toast error1" id="error1">
      <div class="toast-contenido">
        <div class="text1">
          El usuario ya existe
        </div>
      </div>
    </div>
    <div class="toast error2" id="error2">
      <div class="toast-contenido">
        <div class="text1">
          Las contraseñas no coinciden
        </div>
      </div>
    </div>
    <div class="toast alerta1" id="alerta1">
      <div class="toast-contenido">
        <div class="text1">
          Ingresa una fecha válida
        </div>
      </div>
    </div>
    <section>
      <div class="logo">
        <a href="../../index.php">
        <img src="../../images/Daale_Blanco.png" alt="">
        </a>
      </div>
        <form class="animated fadeInUp" action="" id="formulario" method="post">
		       		<h2 class="">Regístrate como Nutriólogo</h2>
              <div class="line"></div>
              <input type="text" name="nombre" placeholder="Nombre" style="float:left; width:32%; margin-right:2%;" required>
              <input type="text" name="ap_p" placeholder="Apellido Paterno" style="width:32%; float:left;  margin-right:2%;" required>
              <input type="text" name="ap_m" placeholder="Apellido Materno" style="width:32%; float:left;" required>

              <input type="text" name="user" placeholder="Nombre de usuario"  style="width:49%; margin-right:49%;" required>

              <h3 style="width:49%; float:left; margin-right:2%;">Fecha de Nacimiento</h3>
              <h3 style="width:49%; float:left;">Sexo</h3>

              <input type="date" name="fecha" placeholder="Fecha de Nacimiento" style="width:49%; float:left; margin-right:2%; height:40px;" required>
              <select name="sexo" class="select">
                <option value="H" class="dentro-select" required>Hombre</option>
                <option value="M" class="dentro-select">Mujer</option>
              </select>



              <input type="email" name="correo" placeholder="Correo" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" style="width:59%; margin-right:2%; float:left;" required>
              <input type="number" name="telefono" placeholder="Teléfono" style="width:39%; float:left; height:40px;" required>


              <input type="password" name="pass" placeholder="Contraseña" required>
              <input type="password" name="rpass" placeholder="Repetir contraseña" required>

              <h3 style="width:49%; float:left; margin-right:2%;">Preguntas de seguridad</h3>
              <h3 style="width:49%; float:left;">Respuestas</h3>
              <select name="pregunta1"  class="select-pregunta">
                <?php
                  include("../../php/config.php");
                  $query2 = "SELECT * FROM preguntas ORDER BY ID_Preguntas ASC";
                  $resultado2 = $conexion->query($query2);
                  while($row2 = $resultado2->fetch_assoc()){
                ?>
                <option value="<?php echo $row2['ID_Preguntas']; ?>" require><?php echo $row2['Pregunta']; ?></option>
              <?php } ?>
              </select>
              <input type="text" name="respuesta1" placeholder="" style="width:49%; float:left; height:40px;" required>
              <select name="pregunta2" class="select-pregunta">
                <?php
                  include("../../php/config.php");
                  $query2 = "SELECT * FROM preguntas ORDER BY ID_Preguntas DESC";
                  $resultado2 = $conexion->query($query2);
                  while($row2 = $resultado2->fetch_assoc()){
                ?>
                <option value="<?php echo $row2['ID_Preguntas']; ?>" require><?php echo $row2['Pregunta']; ?></option>
              <?php } ?>
              </select>
              <input type="text" name="respuesta2" placeholder="" style="width:49%; float:left;" required>

		          	<input type="submit" value="Continuar" id="boton">

                <div class="text-left" style="float:left;"><a href="../seleccion-registro.php">Cambiar de tipo de usuario.</a>  </div>
	   		 </form>
         <script type="text/javascript">
           jQuery(document).on('submit', '#formulario', function(event){
             event.preventDefault();

             jQuery.ajax({
               url: '../../php/nutriologo/registrar.php',
               type: 'POST',
               dataType: 'json',
               data: $(this).serialize(),
               beforeSend: function(){
                   $('.btn').val('Validando...');
               }
             })
             .done(function(respuesta){
               console.log(respuesta);
               if (!respuesta.error1 && !respuesta.error2 && !respuesta.error3) {
                 if (respuesta.var == 1) {
                   location.href = 'perfil.php';
                 }
               }else if (respuesta.error1 == true) {
                 $('#error1').slideDown('slow');
                 setTimeout(function(){
                     $('#error1').slideUp('slow');
                 }, 3000);
                 $('.btn').val('Continuar');
               }else if (respuesta.error2 == true) {
                 $('#error2').slideDown('slow');
                 setTimeout(function(){
                     $('#error2').slideUp('slow');
                 }, 3000);
                 $('.btn').val('Continuar');
               }else if (respuesta.error3 == true) {
                 $('#alerta1').slideDown('slow');
                 setTimeout(function(){
                     $('#alerta1').slideUp('slow');
                 }, 3000);
                 $('.btn').val('Continuar');
               }
             })
             .fail(function(resp){
               console.log(resp);
             })
             .always(function(respuesta){
               console.log("complete");
             });
           });
         </script>
		</section>
    <?php include('../../partes/footer-fuera.php'); ?>
  </body>
</html>
