<<?php
// Incluye el archivo de autoloading.
require_once('../vista/Autoload.php');

// Crea una instancia de la clase 'router'.
$router = new router();

// Ejecuta el router para gestionar las rutas.
$router->run();

// Imprime "exitoso".
echo "exitoso";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Configuración del encabezado HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" type="text/css" href="/apiweb/vista/styles.css">
    <!-- Título de la página -->
    <title>ApiWep</title>
</head>

<body>

    <!-- Botón para conectar a la API -->
    <div class="btnContainer">
        <a href="ConexionApi.php" class="btnApi">Conectar a la API</a>
    </div>

    <!-- Botón para ir a la página de login -->
    <div class="btnContainer">
        <a href="../vista/login.php" class="btnApi">Login</a>
    </div>

    <!-- Sección para mostrar el listado de películas -->
    <section class="py-5">
        <div class="container">
            <!-- Título de la sección -->
            <h2 class="mb-4">Listado de Películas</h2>
            <!-- Tabla responsive para mostrar los datos de las películas -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <!-- Encabezado de la tabla -->
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Película</th>
                            <th>Título</th>
                            <th>Imagen</th>
                            <th>Sinopsis</th>
                            <th>Fecha Lanzamiento</th>
                            <th>Idiomas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        <?php
                        // Crea una instancia de la clase 'Database' y obtiene la conexión a la base de datos.
                        $dataBase = new Database();
                        $conexion = $dataBase->getConexionn();

                        // Crea una instancia de la clase 'peliculass' utilizando la conexión a la base de datos.
                        $usuarioModelo = new peliculass($conexion);

                        // Obtiene todos los registros de películas.
                        $result = $usuarioModelo->getAll();

                        // Verifica si hay películas para mostrar.
                        if (count($result) > 0) {
                            foreach ($result as $data) {
                        ?>
                                <!-- Fila de la tabla para cada película -->
                                <tr>
                                    <td><?php echo $data['id_pelicula']; ?></td>
                                    <td><?php echo $data['titulo']; ?></td>
                                    <!-- Imagen de la película obtenida de la API -->
                                    <td><img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $data['thumbnail']; ?>" alt="Movie Poster"></td>
                                    <td><?php echo $data['sinopsis']; ?></td>
                                    <td><?php echo $data['anio_estreno']; ?></td>
                                    <td><?php echo $data['id_director']; ?></td>
                                    <!-- Enlace para mostrar detalles o realizar acciones -->
                                    <td>
                                        <a class="btn btn-agregar"  href="../controlador/Crud.php">Mostrar</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            // Mensaje si no hay películas encontradas.
                            echo "<tr><td colspan='7'>No se encontraron películas.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</body>

</html>
