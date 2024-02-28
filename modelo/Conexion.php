<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $clave = "";
    private $bd = "apiweb";
    private $connecion;  

    // Constructor de la clase.
    public function __construct()
    {
        // Configuración de opciones para PDO.
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // Inicia una conexión a la base de datos.
        $this->connecion = new PDO("mysql:host=$this->host;dbname=$this->bd", $this->user, $this->clave);

        // Configura la codificación de caracteres a UTF-8.
        $this->connecion->exec("SET CHARACTER SET UTF8");

        // Establece las opciones de manejo de errores.
        $this->connecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para obtener la conexión a la base de datos.
    public function getConexionn() {
        return $this->connecion;
    }
}
?>
