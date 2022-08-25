<?php
include_once "Juego.php";
class Extremo extends Juego{

    public function __construct(){
        parent::__construct();
    }

    public function cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque){
        parent::cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque);
    }


    /**
     * Recupera los datos de un visitante por su codigo
     * @param int $cod
     * @return true en caso de encontrar los datos, false en caso contrario
     */

    public function Buscar($cod){
        $base = new BaseDatos();
        $sql = "SELECT * FROM extremo WHERE codjuego=".$cod;
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
     * Retorna un array con los juegos que cumplan con una condición, en
     * caso de no tener condición retorna todos los juegos que se encuentran
     * almacenados en la base de datos
     * @param string $condicion
     * @return array
    */
    public function listar($condicion=""){
        $arreglo=array();
        $base= new BaseDatos();
        $sql= "SELECT * FROM extremo INNER JOIN juego ON extremo.codjuego = juego.codjuego ";

        if($condicion!=""){
            $sql.= ' WHERE ' .$condicion;
        }

        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objExtremo= new Extremo();
                    $objExtremo->Buscar($row['codjuego']);
                    array_push($arreglo,$objExtremo);
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
     * Inserta un Juego en la base de datos,
     * retorna true si el dato se insertó correctamente, false en caso contrario
     * @param
     * @return boolean $resp
     */
    public function insertar(){
        $base = new BaseDatos();
        $resp= false;

        if(parent::insertar()){

            $sql= "INSERT INTO extremo(codjuego) VALUES (".parent::getCodJuego().")";
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
     * Elimina un Juego almacenado en la base de datos,
     * retorna true si el dato se eliminó correctamente false en caso contrario
     * @return boolean $resp
     */

    public function eliminar(){
        $base =new BaseDatos();
        $resp =false;
        if($base->Iniciar()){
            $sql="DELETE FROM extremo WHERE codjuego=".$this->getCodjuego();
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

    public function __toString(){
        return "\nJuego Extremo: ".parent::__toString();
    }


    /**
     * Si el pase es con aptitud se le permite jugar
     * retorna un array 
     * @return array $resp 
     */
    public function jugarJuego($unPase){
        $resp=array();
        if($unPase->getConAptitud()==1){
            $resp= parent::jugarJuego($unPase);
        }else{
            $resp['juega']=false;
            $resp['motivo']="Pase sin aptitud";
        }
        return $resp;
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
        $objExtremo=new Extremo();
        $coljuegos=$objExtremo->listar();
        $tam=count($coljuegos);
        $listaJuego=$objExtremo->burbuja($coljuegos,$tam);
        return $listaJuego;
    }
    


    
    public function juegosActivos($act){
        $arreglo=array();

        $base = new BaseDatos();
        $sql =" SELECT * FROM extremo INNER JOIN juego ON extremo.codjuego = juego.codjuego WHERE activo=".$act;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objExtremo= new Extremo();
                    $objExtremo->Buscar($row['codjuego']);
                    array_push($arreglo,$objExtremo);
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