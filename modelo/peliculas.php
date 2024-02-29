<?php 
// Definición de la clase 'peliculass' que extiende de la clase 'orm'.
class peliculass extends orm {

    // Constructor de la clase que recibe una instancia de PDO como parámetro.
    public function __construct(PDO $connecion)
    {
        // Llama al constructor de la clase padre 'orm' con los parámetros específicos.
        parent::__construct('id', 'peliculass', $connecion);
    }
    public function deleteByIdd($id)
    {
        $id = $_GET['id'];
        try {
            $stm = $this->db->prepare("DELETE  FROM {$this->table} WHERE id_pelicula =:id");
            $stm->bindValue(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }

    public function updateByIdd($id, $data)
{
    $sql = "UPDATE {$this->table} SET ";
    
    // Verificar si $data es un array antes de usar foreach
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $sql .= "{$key} = :{$key}, ";
        }

        // Eliminar la última coma y espacio en blanco
        $sql = rtrim($sql, ', ');

        $sql .= " WHERE id_pelicula = :id";

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
    } else {
        // Manejar el caso donde $data no es un array
        echo "Los datos proporcionados no son válidos.";
    }
}

    
} 
?>
