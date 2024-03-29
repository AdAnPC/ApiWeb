<?php
// Incluye el archivo de autoloader que probablemente carga las clases necesarias.
require_once('../vista/Autoload.php');

// Crea una instancia de la clase de conexión a la base de datos.
$dataBase = new Database();
$conexion = $dataBase->getConexionn();

// Crea una instancia del modelo de género, asumiendo que existe la clase 'genero'.
$usuarioModelo = new genero($conexion);

// Obtiene todos los géneros de la base de datos.
$result = $usuarioModelo->getAll();

// Verifica si la conexión a la base de datos se realizó correctamente.
if ($conexion) {
    // Inicializa el valor del último ID de género.
    $ultimo_id = 0;

    // Itera sobre los resultados obtenidos de la base de datos.
    foreach ($result as $data) {
        // Obtiene el último ID de género de la tabla 'generos'.
        $query = "SELECT MAX(id_genero) as ultimo_id FROM generos";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ultimo_id = $row['ultimo_id'];
    }

    // Incrementa en 1 para obtener el nuevo ID de género.
    $nuevo_id = $ultimo_id + 1;
    
   $ap="https://api.themoviedb.org/3/movie/popular?api_key=cc5c27f75d0cb30aed9d3db7ff4b06fb";
   $res = file_get_contents($ap);
        $da = json_decode($res, true);

        foreach ($da['results'] as $mo) {
$id = isset($mo['id']) ? $mo['id'] : '';       
     var_dump($id);


        // Obtiene la información de las películas populares desde la API de TMDb.
        $url = "https://api.themoviedb.org/3/movie/{$id}/videos?api_key=cc5c27f75d0cb30aed9d3db7ff4b06fb";
        $response = file_get_contents($url);
        
        $data = json_decode($response, true);
        
        // Itera sobre las películas obtenidas.
        foreach ($data['results'] as $movie) {
            
            // Itera sobre los IDs de películas (1 a 10) para obtener más detalles de cada película.
           
              
                // Extrae el título original de la película.
                $nombre = isset($movie['original_title']) ? $conexion->quote($movie['original_title']) : '';
                $peli = isset($movie['key']) ? $conexion->quote($movie['key']) : '';

                // Itera sobre los géneros de la película.
               
            
        

        // Genera una cantidad aleatoria entre 1 y 100
        $cantidad = rand(1, 50);

        // Prepara la consulta SQL para insertar datos en la tabla 'generos'.
        $query = "INSERT INTO generos(nombre_genero, linkPeli) VALUES (:nombre, :peli)";

        // Prepara la sentencia SQL.
        $stmt = $conexion->prepare($query);

        // Enlaza los parámetros de la consulta preparada.
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':peli', $peli);

        // Ejecuta la consulta y muestra mensajes de éxito o error.
        if ($stmt->execute()) {
            echo "Datos insertados correctamente para la película: $peli<br>";
        } else {
            echo "Error al insertar datos para la película: $peli - " . $stmt->errorInfo()[2] . "<br>";
        }
    }
    }
        
}

