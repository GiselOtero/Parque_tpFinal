<?php
include_once "Juego.php";
class Extremo extends Juego{

    public function __construct(){
        parent::__construct();
    }

    public function cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque){
        parent::cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque);
    }


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

    
}
?>