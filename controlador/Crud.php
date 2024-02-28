<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                            if (count($result) > 0) {
                                foreach ($result as $data) {
                        ?>
                                    <tr>
                                        <td><?php echo $data['id_pelicula']; ?></td>
                                        <td><?php echo $data['titulo']; ?></td>
                                        <td><?php echo $data['sinopsis']; ?></td>
                                        <td><?php echo $data['anio_estreno']; ?></td>
                                        <td><?php echo $data['id_director']; ?></td>
                                        <td>
                                            <a class="btn btn-agregar">Modificar</a>

                                        </td>
                                        <td>
                                            <a class="btn btn-agregar">eliminar</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-agregar" >agregar</a>
                                        </td>
                                    </tr>
                        <?php }
                            } else {
                                echo "<tr><td colspan='7'>No se encontraron películas.</td></tr>";
                            }
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
</body>

</html>