<?php
require_once('../vista/Autoload.php');
//maneja los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//pregunta si los campos estan vacios 
if (!empty($_POST["Login"])) {
    if (empty($_POST["username"]) and empty($_POST["password"])) {
        echo "los campos estan vacios ";
    } else {
        //lena los compos con los datos que recibe desde html
        $usuario = $_POST["username"];
        $clave = $_POST["password"];
        $dataBase = new Database();
        $conexion = $dataBase->getConexionn();

        $usuarioModelo = new usuarios($conexion);
        //pregunta si el usuario existe y si existe inicia sesion y verifica si es correcta la contraseña 
        if ($usuarioModelo->usuarioExiste($usuario)) {

            $existingUser = $usuarioModelo->getByid($usuario);
            if (is_array($existingUser) && $existingUser['contrasena'] == $clave) {
                echo "Inicio de sesión exitoso";
                header('location: ../modelo/page');
                exit;
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            //si no existe un usuario lo crea 
            $result = $usuarioModelo->insert(['nombre_usuario' => $usuario, 'contrasena' => $clave]);
            if ($result) {
                echo "exito";
                header("../Public/mostrarPeliculas.php");
            } else {
                echo "no se pudo redirigir la pagina";
            }
        }
    }
}
