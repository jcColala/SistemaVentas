<!DOCTYPE html>
<html> 
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/mycss/login.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/public/icomoon/style.css">
</head>
<body>
  <div class="Padre_img_login">
     <div class="div_img">

     </div>
     <div class="div_login">
         <form  action="<?php echo base_url();?>/Login/verificar" method="post" >
          <div class="form_div_login">
            <div><span class="icon-account_box"></span><input type="text" name="usuario" id="usuario" required></div>
            <div><span class="icon-fingerprint"></span><input type="password" name="pasword" id="pasword" required></div><br><br>
            <button type="submit">Ingresar</button>
          </div>
        </form>
     </div>
      <div class="div_mensaje" id="div_mensaje">No existe el usuario, o a escrito mal su Usuario/Contraseña<br><span class="icon-mood_bad"></span></div>
     <div class="linea"></div>
     <div class="login_ano"><?=date('Y')?></div>
  </div>
</body>
</html>
