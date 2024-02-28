<?php
// Definición de la clase 'orm'.
class orm
{
    // Propiedades protegidas para la clase 'orm'.
    protected $id;
    protected $table;
    protected $db;

    // Constructor de la clase 'orm' que recibe la clave primaria, nombre de la tabla y la conexión PDO.
    public function __construct($id, $table, PDO $connecion)
    {
        $this->id = $id;
        $this->table = $table;
        $this->db = $connecion;
    }

    // Método para obtener todos los registros de la tabla.
    public function getAll()
    {
        $stm = $this->db->prepare("SELECT * FROM {$this->table}");
        $stm->execute();
        return $stm->fetchAll();
    }

    // Método para obtener un registro por su ID.
    public function getByid($id)
    {
        $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE nombre_usuario =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();

        //return $stm->fetchAll(); //linea de codigo cambiada 

        $result= $stm->fetch();

        return ($result !== false) ? $result : null;

    }

    public function getByidd($id)
    {
        $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_pelicula =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
       $result= $stm->fetch();

        return ($result !== false) ? $result : null;
    }

    // Método para eliminar un registro por su ID.
    public function deleteById($id)
    {
        try {
            $stm = $this->db->prepare("DELETE * FROM {$this->table} WHERE id =:id");
            $stm->bindValue(":id ", $id);
            $stm->execute();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    // Método para actualizar un registro por su ID y con datos proporcionados.
    public function updateById($id, $data)
    {
        $sql = "UPDATE  {$this->table} SET ";
        foreach ($data as $key => $value) {
            $sql .= "{$key}= :{$key},";
        }
        $sql = trim($sql, ',');
        $sql .= "WHERE  id = :id";
        try {
            $stm = $this->db->prepare($sql);
            foreach ($data as $key => $value) {
                $stm->bindValue(":{$key}", $value);
            }
            $stm->bindValue(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    // Método para insertar un nuevo registro con datos proporcionados.
    public function insert($data)
    {
        $sql = "INSERT INTO {$this->table}(";
        foreach ($data as $key => $value) {
            $sql .= "{$key},";
        }
        $sql = trim($sql, ',');
        $sql .= ") VALUES (";

        foreach ($data as $key => $value) {
            $sql .= ":{$key},";
        }
        $sql = trim($sql, ',');
        $sql .= ")";

        $stm = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
            $key = trim($key);
            $stm->bindValue(":{$key}",  $value);
        }

        echo $sql;
        print_r($data);
        $stm->execute();
    }

    // Método para implementar paginación en la obtención de registros.
    public function paginacion($page, $limi)
    {
        $offset = ($page - 1) * $limi;
        $rows = $this->db->query("SELECT COUNT(*) FROM {$this->table}")->fetchColumn();
        $sql = "SELECT * FROM {$this->table} LIMIT {$offset},{$limi}";
        $stm = $this->db->prepare($sql);
        $stm->execute();

        $pages = ceil($rows / $limi);
        $data = $stm->fetchAll();

        return [
            'data' => $data,
            'page' => $page,
            'limi' => $limi,
            'pages' => $pages,
            'rows' => $rows,
        ];
    }

    // Método para verificar si un usuario existe por su ID.
    public function usuarioExiste($id)
    {
        $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE nombre_usuario =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
        $user = $stm->fetch();

        return $user !== false;
    }

    // Métodos para obtener información específica de películas por su ID.
    public function getMovieGenres($id)
    {
        $stm = $this->db->prepare("SELECT nombre_genero FROM {$this->table} WHERE id_pelicula =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
        return $stm->fetch();
    }

    public function getMovieLink($id)
    {
        $stm = $this->db->prepare("SELECT linkPeli FROM {$this->table} WHERE id_pelicula =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
        return $stm->fetch();
    }

    // Método para obtener todos los géneros de películas.
    public function getAllMovieGenres()
    {
        $stm = $this->db->prepare("SELECT nombre_genero FROM {$this->table}");
        $stm->execute();
        return $stm->fetchAll();
    }
}
?>
