<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>

<?php
// Incluye el archivo de autoloader que carga las clases necesarias.
require_once('../vista/Autoload.php');

// Crea una instancia de la clase de conexión a la base de datos.
$dataBase = new Database();
$conexion = $dataBase->getConexionn();

// Crea una instancia del modelo de películas
$usuarioModelo = new peliculass($conexion);

// Obtiene todas las películas de la base de datos.
$result = $usuarioModelo->getAll();

// Verifica si la conexión a la base de datos se realizó correctamente.
if ($conexion) {
    $ultimo_id = 0;
    $pe_id = '';
    // Itera sobre los resultados obtenidos de la base de datos.
    foreach ($result as $data) {
        // Obtiene el último ID de película de la tabla 'peliculass'.
        $query = "SELECT MAX(id_pelicula) as ultimo_id FROM peliculass";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ultimo_id = $row['ultimo_id'];
    }

    // Incrementa en 1 para obtener el nuevo ID de película.
    $nuevo_id = $ultimo_id + 1;

    // Itera sobre las páginas de películas populares (solo 1 página en este caso).
   // for ($i = 1; $i <= 1; $i++) {
        // Obtiene la información de las películas populares desde la API de TMDb.
       
    
      $u= "https://api.themoviedb.org/3/movie/popular?api_key=cc5c27f75d0cb30aed9d3db7ff4b06fb&language=es";

        $ponse = file_get_contents($u);
        
        $ta = json_decode($ponse, true);
        // Itera sobre las películas obtenidas.
        foreach ($ta['results'] as $movie) {
            // Extrae la información de la película y la asigna a variables.
            $nombre = isset($movie['title']) ? $conexion->quote($movie['title']) : '';
            $fecha = isset($movie['release_date']) ? $conexion->quote($movie['release_date']) : '';
            $duracion = isset($movie['budget']) ? $conexion->quote($movie['budget']) : '';

            $sinopsis = isset($movie['overview']) ? $conexion->quote($movie['overview']) : '';
            $imagen = isset($movie['poster_path']) ? $movie['poster_path'] : '';

            $lenguaje = isset($movie['original_language']) ? $conexion->quote($movie['original_language']) : '';
            $id = isset($movie['id']) ? $movie['id'] : '';



//            $url = "https://api.themoviedb.org/3/movie/{$id}/videos?api_key=cc5c27f75d0cb30aed9d3db7ff4b06fb";
        //    $response = file_get_contents($url);
            
       //     $data = json_decode($response, true);
            
        //    foreach ($data['results'] as $mo) {
        //        $pe_id = isset($mo['key']) ? $conexion->quote($mo['key']) : '';
    
    
            // Genera un número aleatorio para la cantidad 
            $cantidad = rand(1, 100);

            // Prepara la consulta SQL para insertar datos en la tabla 'peliculass'.
            $query = "INSERT INTO peliculass(titulo, anio_estreno, sinopsis, id_director, duracion_minutos, thumbnail, id_genero, video_id) 
                      VALUES (:nombre, :fecha, :sinopsis, :lenguaje, :duracion, :imagen, :id, :pe_id)";

            // Prepara la sentencia SQL.
            $stmt = $conexion->prepare($query);

            // Enlaza los parámetros de la consulta preparada.
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':sinopsis', $sinopsis);
            $stmt->bindParam(':lenguaje', $lenguaje);
            $stmt->bindParam(':duracion', $duracion);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':pe_id', $pe_id);

            // Ejecuta la consulta y muestra mensajes de éxito o error.
            if ($stmt->execute()) {
                echo "Datos insertados correctamente para la película: $nombre<br>";
            } else {
                echo "Error al insertar datos para la película: $nombre - " . $stmt->errorInfo()[2] . "<br>";
            }
        
        }
    

} else {
    echo "No se encontraron datos en la API";
}



?>
