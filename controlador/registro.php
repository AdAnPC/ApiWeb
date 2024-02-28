<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vista/login-styles.css">
    <title>Registro</title>
</head>
<body>
<div class="background-wrap">
  <div class="background"></div>
</div>

<form id="accesspanel" action="registro" method="post">
  <h1 id="litheader">AECEND</h1>
  <div class="inset">
    <p>
      <input type="text" name="username" id="username" placeholder="Nombre de usuario" required>
    </p>
    <p>
      <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="Contraseña" required>
    </p>
    <div style="text-align: center;">
      <div class="checkboxouter">
        <input type="checkbox" name="rememberme" id="remember" value="Remember">
        <label class="checkbox"></label>
      </div>
    </div>
    <input class="loginLoginValue" type="hidden" name="service" value="registro" />
  </div>
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Registrar">
  </p>
</form>
</body>
</html>
