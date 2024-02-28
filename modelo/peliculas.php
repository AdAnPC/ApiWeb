<?php 
// Definición de la clase 'peliculass' que extiende de la clase 'orm'.
class peliculass extends orm {

    // Constructor de la clase que recibe una instancia de PDO como parámetro.
    public function __construct(PDO $connecion)
    {
        // Llama al constructor de la clase padre 'orm' con los parámetros específicos.
        parent::__construct('id', 'peliculass', $connecion);
    }
    public function getByidd($id)
    {
        $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_pelicula =:id");
        $stm->bindValue(":id", $id);
        $stm->execute();
       $result= $stm->fetch();

        return ($result !== false) ? $result : null;
    }
    

    public function deleteById($id)
    {
        try {
            $stm = $this->db->prepare("DELETE * FROM {$this->table} WHERE id_pelicula =:id");
            $stm->bindValue(":id ", $id);
            $stm->execute();
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
} 
?>
