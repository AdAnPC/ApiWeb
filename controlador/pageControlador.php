<?php
//clase para controlar las clases por la url
class pageControlador extends orm {

    public function __construct(PDO $conexion)
    {
        
    }
    //Funcion para mostrar las peliculas 
    public function peliculas(){
       require_once('../public/mostrarPeliculas.php');
      //  require_once('../vista/styles.css');
    }

    public function pe(){
      
    }
   //funcion para mostrar la api en la url 
    public function ApI(){
        echo 'api ';
        require_once('../modelo/ConexionApi.php');
       // require_once('../Public/index.php');
 
     }


}