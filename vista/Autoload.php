<?php

// Se incluyen los archivos necesarios para la funcionalidad del sistema
require_once('../Public/router.php');       // Archivo que define el router y la gestión de rutas
require_once('../Public/config.php');       // Archivo de configuración del sistema
require_once('../modelo/orm.php');          // Clase base para el mapeo objeto-relacional
require_once('../modelo/genero.php');       // Clase que representa la entidad 'genero'
require_once('../modelo/peliculas.php');    // Clase que representa la entidad 'peliculas'
require_once('../modelo/usuarios.php');     // Clase que representa la entidad 'usuarios'
require_once('../modelo/Conexion.php');     // Clase que maneja la conexión a la base de datos
//require_once('../Test/testUni.php');      // Archivo que contiene pruebas unitarias (actualmente comentado)
require_once('../cotroller/conLogin.php');  // Controlador para el manejo de la autenticación y el login
