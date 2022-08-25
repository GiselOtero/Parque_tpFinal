<?php
include_once "Juego.php";
include_once "BaseDatos.php";
include_once "Parque.php";


class Especial extends Juego{

    public function __construct(){
        parent::__construct();
    }

    public function cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque){
        parent::cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque);
    }

   
    /**
     * Recupera los datos de un Juego por su cod
     * @param int $cod
     * @return true en caso de encontrar los datos, false en caso contrario
     */

    public function Buscar($cod){
        $base = new BaseDatos();
        $sql = "SELECT * FROM especial WHERE codjuego=".$cod;
        $resp=false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){
                    parent::Buscar($cod);
                    $resp=true;
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }

        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    /**
     * Retorna un array con los juegoa especiales que cumplan con una condición, en
     * caso de no tener condición retorna todos los juegoa especiales que se encuentran almacenados en la base de datos
     * @param string $condicion
     * @return array $arreglo
    */
    public function listar($condicion=""){
        $arreglo=array();
        $base= new BaseDatos();
        $sql= "SELECT * FROM especial INNER JOIN juego ON especial.codjuego = juego.codjuego ";

        if($condicion!=""){
            $sql.= ' WHERE ' .$condicion;
        }

        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objespecial= new Especial();
                    $objespecial->Buscar($row['codjuego']);
                    array_push($arreglo,$objespecial);
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
    }


    /**
     * Inserta un Juego especial en la base de datos,
     * retorna true si el dato se insertó correctamente, false en caso contrario
     * @param
     * @return boolean $resp
     */

    public function insertar(){
        $base = new BaseDatos();
        $resp= false;

        if(parent::insertar()){

            $sql= "INSERT INTO especial(codjuego) VALUES (".parent::getCodJuego().")";
            if($base->Iniciar()){

                if($base->Ejecutar($sql)){
                    $resp=true;
                }else{
                    $this->setmensajeoperacion($base->getError());
                }

            }else{
                $this->setmensajeoperacion($base->getError());
            }

        }
        return $resp;
    }


    /**
     * Elimina un juego especial almacenado en la base de datos,
     * retorna true si el dato se eliminó correctamente false en caso contrario
     * @return boolean $resp
     */

    public function eliminar(){
        $base =new BaseDatos();
        $resp =false;
        if($base->Iniciar()){
            $sql="DELETE FROM especial WHERE codjuego=".$this->getCodjuego();
            if($base->Ejecutar($sql)){
                if(parent::eliminar()){
                    $resp=true;
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    

    /**
     * Retorna un String con la información de juego especial
     * @return string
     */
    public function __toString(){
        return "\nJuego Especial: ".parent::__toString();
    }


    public function jugarJuego($unPase){
        return parent::jugarJuego($unPase);
    }

    public function burbuja($coljuegos,$num){
        return parent::burbuja($coljuegos,$num);
    }

    /**
     * Obtiene la lista de todos los juegos y los ordena según el total de personas que jugaron
     * @param  
     * @return array $listaJuego
     */
    public function juegosMasJugados(){
        $objespecial=new Especial();
        $coljuegos=$objespecial->listar();
        $tam=count($coljuegos);
        $listaJuego=$objespecial->burbuja($coljuegos,$tam);
        return $listaJuego;
    }


    public function juegosActivos($act){
        $arreglo=array();

        $base = new BaseDatos();
        $sql =" SELECT * FROM especial INNER JOIN juego ON especial.codjuego = juego.codjuego WHERE activo=".$act;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objespecial= new Especial();
                    $objespecial->Buscar($row['codjuego']);
                    array_push($arreglo,$objespecial);
                }
            }
        }
        return $arreglo;
    }


    /**
     * Recupera los datos de un Juego especial por su Nombre
     * retorna todos los juegps con el nombre ingresado
     * @param string $nom
     * @return array 
     */

    public function buscarXNombre($nom){
        $arreglo=array();

        $base = new BaseDatos();
        $sql =" SELECT * FROM especial INNER JOIN juego ON especial.codjuego = juego.codjuego WHERE nombre=".$nom;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objespecial= new Especial();
                    $objespecial->Buscar($row['codjuego']);
                    array_push($arreglo,$objespecial);
                }
            }
        }
        return $arreglo;
    }


    public function activarJuego(){
        return parent::activarJuego();
    }
}
?>