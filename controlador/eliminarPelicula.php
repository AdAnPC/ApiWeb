<?php
session_start();
require_once('../vista/Autoload.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['confirmDelete'])) {
        try {
            $dataBase = new Database();
            $conexion = $dataBase->getConexionn();

            $peliculasModelo = new peliculass($conexion);
            $peliculasModelo->deleteByIdd($id); // Llamando a la función deleteById
            $_SESSION['message'] = 'Se ha eliminado la película con ID: ' . $id;
            header('Location: ../modelo/page/peliculas');
            exit();
        } catch (Exception $e) {
            // Handle exception here
            echo "An error occurred: " . $e->getMessage();
        }
    } elseif (isset($_POST['cancelDelete'])) {
        header('Location: ../modelo/page/peliculas');
        exit();
    } else {
        echo "<div style='background-color: #141414; color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);'>";
        echo "<p style='font-size: 18px; margin-bottom: 20px;'>¿Estás seguro de que deseas eliminar esta película con ID: $id?</p>";
        
        echo "<form method='POST' action=''>
                <input type='hidden' name='id' value='$id'>
                <input type='hidden' name='confirmDelete' value='1'>
                <input type='submit' value='Sí, estoy de acuerdo' style='background-color: #e50914; color: #fff; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;'>
              </form>";
        
        echo "<form method='POST' action=''>
                <input type='hidden' name='cancelDelete' value='1'>
                <input type='submit' value='No, estoy de acuerdo' style='background-color: #333; color: #fff; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;'>
              </form>";
        
        echo "</div>";
        
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Película</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Helvetica', sans-serif;
        }
        /* Add more styles as per your requirement */
    </style>
</head>
<body>
    <!-- Your PHP code here -->
</body>
</html>
