<?php
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

    // Redirigir de vuelta a la lista de películas
    header('Location: ');
    exit;
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

<form action="" method="post">
    <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $pelicula['titulo']; ?>">
    <!-- Aquí puedes agregar más campos para los otros datos de la película -->
    <input type="submit" value="Actualizar">
</form>