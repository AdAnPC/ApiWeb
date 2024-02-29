<?php

require_once('../vista/Autoload.php');

$id = $_GET['id']; // Obteniendo el ID de la URL

try {
    $dataBase = new Database();
    $conexion = $dataBase->getConexionn();

    $peliculasModelo = new peliculass($conexion);
    $peliculasModelo->deleteByIdd($id); // Llamando a la función deleteById

} catch (Exception $e) {
    // Handle exception here
    echo "An error occurred: " . $e->getMessage();
}