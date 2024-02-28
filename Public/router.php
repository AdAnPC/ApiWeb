<?php
// Definición de la clase 'router'
class router{
    // Propiedades privadas para almacenar el controlador y el método a ejecutar
    private $controlador;
    private $metodo;

    // Constructor de la clase
    public function __construct()
    {
        // Llama al método 'matchRoute' al instanciar la clase
        $this->matchRoute();
    }

    // Método para determinar la ruta a partir de la URL
    public function matchRoute()
    {
        // Divide la URL en partes usando el delimitador '/'
        $url = explode('/', URL);

        // Asigna el controlador y el método basándose en las partes de la URL
        $this->controlador = !empty($url[1]) ? $url[1] : 'page';
        $this->metodo = !empty($url[2]) ? $url[2] : 'peliculas';

        // Agrega 'Controlador' al nombre del controlador
        $this->controlador = $this->controlador . 'Controlador';

        // Construye la ruta al archivo del controlador
        $filePath =  '../controlador/' . $this->controlador . '.php';

        // Verifica si el archivo del controlador existe
        if (!file_exists($filePath)) {
            throw new Exception("Controller file does not exist: $filePath");
        }

        // Incluye el archivo del controlador
        require_once($filePath);
    }

    // Método para ejecutar el controlador y el método correspondientes
    public function run()
    {
        // Crea una instancia de la clase 'database' para obtener la conexión a la base de datos
        $db = new database();
        $conexion = $db->getConexionn();

        // Crea una instancia del controlador y ejecuta el método
        $controlador = new $this->controlador($conexion);
        $metodo = $this->metodo;
        $controlador->$metodo();
    }
}
?>
