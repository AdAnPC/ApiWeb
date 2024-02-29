<?php
session_start();
require_once('../vista/Autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí es donde procesarías el formulario y actualizarías la película en la base de datos
    $dataBase = new Database();
    $conexion = $dataBase->getConexionn();
    $peliculasModelo = new peliculass($conexion);



    $id_pelicula = $_POST['id_pelicula'];
    $formData = array(
        'id_pelicula' => $_POST['id_pelicula'],
        'titulo' => $_POST['titulo'],
        // Agrega aquí otros campos del formulario
    );

    // Actualizar la película en la base de datos
    $peliculasModelo->updateByIdd($id_pelicula,$formData);
    $_SESSION['message'] = 'Los datos se han actualizado correctamente. ' . $id_pelicula;
    // Redirigir de vuelta a la lista de películas
    //header('Location: ');
    //exit;
} else {
    // Aquí es donde mostrarías el formulario de edición de la película
    $dataBase = new Database();
    $conexion = $dataBase->getConexionn();
    $peliculasModelo = new peliculass($conexion);

    // Obtener la película actual de la base de datos
    $pelicula = $peliculasModelo->getByidd($_GET['id']);

    // Mostrar el formulario con los datos actuales de la película
   // include 'modifyMovieForm.php';
}
?>
<?php
$pelicula = $peliculasModelo->getByidd($_GET['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
    <link rel="stylesheet" type="text/css" href="mo-styles.css">
</head>
<body>
   

<form action="" method="post">
    <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $pelicula['titulo']; ?>">
    <label for="sinopsis">Sinopsis:</label>
    <input type="text" id="sinopsis" name="sinopsis" value="<?php echo $pelicula['sinopsis']; ?>">
    <label for="lengua">Idioma:</label>
    <input type="text" id="lengua" name="lengua" value="<?php echo $pelicula['id_director']; ?>">
    <label for="fecha">Año de estreno:</label>
    <input type="text" id="fecha" name="fecha" value="<?php echo $pelicula['anio_estreno']; ?>">
    
    <!-- Aquí puedes agregar más campos para los otros datos de la película -->
    <body>
<?php
if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);  // Limpiar el mensaje después de mostrarlo
}
?>

</body>
    <input type="submit" value="Actualizar">
    <a class="btn btn-agregar"  href="../modelo/page/peliculas">Inicio</a>

</form>

</body>
</html>
