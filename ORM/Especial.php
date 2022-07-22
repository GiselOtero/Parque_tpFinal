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

    

    public function __toString(){
        return "\nJuego Especial: ".parent::__toString();
    }


    public function jugarJuego($unPase){
        return parent::jugarJuego($unPase);
    }

    public function burbuja($coljuegos,$num){
        return parent::burbuja($coljuegos,$num);
    }

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
}
?>