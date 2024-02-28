<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-styles.css">
    <title>Login</title>
</head>
<body>
<div class="background-wrap">
  <div class="background"></div>
</div>
<?php 
    require_once('Autoload.php');

?>
<form id="accesspanel" action="login.php" method="post">
  <h1 id="litheader">Cuenta</h1>
  <div class="inset">
    <p>
      <input type="text" name="username" id="email" placeholder="Email address">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Access code">
    </p>
    <div style="text-align: center;">
      <div class="checkboxouter">
        <input type="checkbox" name="rememberme" id="remember" value="Remember">
        <label class="checkbox"></label>
      </div>
      <label for="remember">fell</label>
    </div>
    <input class="loginLoginValue" type="hidden" name="service" value="login" />
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Iniciar ">
    <input type="submit" name="Loginn" id="goo" onclick="window.location.href='../controlador/registro.php'; return false;" value="Ir a Registro">

  </p>
</form>
</body>
</html>
