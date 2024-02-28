<?php
// Definición de la clase 'genero' que extiende de la clase 'orm'.
class genero extends orm {
    // Constructor de la clase que recibe una instancia de PDO como parámetro.
    public function __construct(PDO $connecion) {
        // Llama al constructor de la clase padre 'orm' con los parámetros específicos.
        parent::__construct('id', 'generos', $connecion);
    }
}
?>
