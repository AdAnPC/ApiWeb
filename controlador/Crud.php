<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Document</title>
</head>

<body>
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Listado de Películas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Película</th>
                            <th>Título</th>
                            <th>Sinopsis</th>
                            <th>Fecha Lanzamiento</th>
                            <th>Idiomas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('../vista/Autoload.php');
                        try {
                            $dataBase = new Database();
                            $conexion = $dataBase->getConexionn();

                            $usuarioModelo = new peliculass($conexion);

                            $result = $usuarioModelo->getAll();



                            foreach ($result as $dataa) {

                                // rest of your code...


                        ?>
                                <tr>
                                    <td><?php echo isset($dataa['id_pelicula']) ? $dataa['id_pelicula'] : ''; ?></td>
                                    <td><?php echo isset($dataa['titulo']) ? $dataa['titulo'] : ''; ?></td>
                                    <td><?php echo isset($dataa['sinopsis']) ? $dataa['sinopsis'] : ''; ?></td>
                                    <td><?php echo isset($dataa['anio_estreno']) ? $dataa['anio_estreno'] : ''; ?></td>
                                    <td><?php echo isset($dataa['id_director']) ? $dataa['id_director'] : ''; ?></td>
                                    <td>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $dataa['video_id']; ?>" frameborder="0" allowfullscreen></iframe>
                                    </td> <?php
                                            // $re = $usu->deleteById('id_pelicula');                                        
                                            ?>
                                    <td>
                                        <a href="modificarPelicula.php?id=<?php echo isset($dataa['id_pelicula']) ? $dataa['id_pelicula'] : ''; ?>" class="btn btn-agregar">Modificar</a>
                                    </td>
                                    <td>
                                        <a href="eliminarPelicula.php?id=<?php echo isset($dataa['id_pelicula']) ? $dataa['id_pelicula'] : ''; ?>" class="btn btn-eliminar">Eliminar</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-agregar" href="../modelo/page/peliculas">Inicio</a>
                                    </td>
                                </tr>
                        <?php }

                            //  } else {
                            //echo "<tr><td colspan='7'>No se encontraron películas.</td></tr>";
                            // }
                        } catch (Exception $e) {
                            // Handle exception here
                            echo "An error occurred: " . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $da['linkPeli']; ?>" frameborder="0" allowfullscreen></iframe>


</body>

</html>