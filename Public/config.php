<?php

// Obtiene la ruta del directorio del script actual.
$folderPath = dirname($_SERVER['SCRIPT_NAME']);

// Obtiene la ruta de la URL solicitada.
$urlPath = $_SERVER['REQUEST_URI'];

// Elimina la parte de la URL correspondiente al directorio del script, obteniendo la URL relativa.
$url = substr($urlPath, strlen($folderPath));

// Define una constante 'URL' con la URL relativa obtenida.
define('URL', $url);

// Define una constante 'URL_PATH' con la ruta del directorio del script.
define('URL_PATH', $folderPath);
