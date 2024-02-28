<?php

use PHPUnit\Framework\MockObject\MockObject;

use PHPUnit\Framework\TestCase;
class testUni extends TestCase  {

    private $orm;
    private $host = "localhost";
    private $user = "root";
    private $clave = "";
    private $bd = "apiweb";
    private $conexion;
    private $connecion;

    protected $id;
    protected $table;
    protected $db;
    
    private function getConexion() {
        if ($this->conexion === null) {
            try {
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->bd;
                $this->conexion = new PDO($dsn, $this->user, $this->clave);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
                // Puedes manejar el error de conexión de la manera que mejor se adapte a tu aplicación
                exit();
            }
        }
        return $this->conexion;
    }
    public function setUp(): void {

        $this->orm = new orm('id ', 'peliculass', $this->getConexion());
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->bd;
        $this->db = new PDO($dsn, $this->user, $this->clave);
        
    
        }
    public function testGetId(){
        $result = $this->orm->getAll();

        // Asegúrate de que $result no sea nulo y sea un array
        $this->assertNotNull($result);
        $this->assertIsArray($result);
    }

        // Test 1: Verificar si se obtiene correctamente un usuario por su ID existente.
public function testGetExisteUnId()
{
    // Supongamos que $this->db es una instancia de la base de datos de prueba.
    $testUserId = 1;
    
    // Supongamos que hay un usuario con ID 1 en la base de datos de prueba.
    $userModel = new orm('id ', 'peliculass', $this->getConexion());
    $result = $userModel->getByIdd($testUserId);

    $this->assertIsArray($result);
    $this->assertNotEmpty($result);
    $this->assertEquals($testUserId, $result['id_pelicula']);
}

// Test 2: Verificar si devuelve null para un ID inexistente.
public function testGetIdNull()
{
    // Supongamos que $this->db es una instancia de la base de datos de prueba.
    $nonExistingUserId = 999;

    // Supongamos que no hay un usuario con ID 999 en la base de datos de prueba.
    $userModel = new orm('id ', 'peliculass', $this->getConexion());
    $result = $userModel->getByIdd($nonExistingUserId);

    $this->assertNull($result);
}

}