<?php
class Juego{
    private $codJuego;
    private $nombreJuego;
    private $cantidadPersonas;
    private $activo;//0 para false, 1 para true
    private $edad;
    private $altura;
    private $maximoPersonas;
    private $totalPersonas; //por dia
    private $objParque;
    private $mensajaoperacion;
    
    public function __construct(){
        $this->codJuego="";
        $this->nombreJuego="";
        $this->cantidadPersonas=0;
        $this->activo="";
        $this->edad="";
        $this->altura="";
        $this->maximoPersonas="";
        $this->totalPersonas=0;
    }

    public function cargar($cod,$nom,$cantP,$esAct,$edad,$altura,$max,$total,$unParque){
        $this->setCodJuego($cod);
        $this->setNombreJuego($nom);
        $this->setCantidadPersonas($cantP);
        $this->setActivo($esAct);
        $this->setEdad($edad);
        $this->setAltura($altura);
        $this->setMaximoPersonas($max);
        $this->setTotalPersonas($total);
        $this->setObjParque($unParque);
    }

    public function getCodJuego(){
        return $this->codJuego;
    }
    public function setCodJuego($valor){
        $this->codJuego=$valor;
    }

    public function getNombreJuego(){
        return $this->nombreJuego;
    }
    public function setNombreJuego($valor){
        $this->nombreJuego=$valor;
    }

    public function getCantidadPersonas(){
        return $this->cantidadPersonas;
    }
    public function setCantidadPersonas($valor){
        $this->cantidadPersonas=$valor;
    }

    public function getActivo(){
        return $this->activo;
    }
    public function setActivo($valor){
        $this->activo=$valor;
    }

    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($valor){
        $this->edad=$valor;
    }

    public function getAltura(){
        return $this->altura;
    }
    public function setAltura($valor){
        $this->altura=$valor;

    }

    public function getMaximoPersonas(){
        return $this->maximoPersonas;
    }
    public function setMaximoPersonas($valor){
        $this->maximoPersonas=$valor;
    }

    public function getTotalPersonas(){
        return $this->totalPersonas;
    }
    public function setTotalPersonas($valor){
        $this->totalPersonas=$valor;
    }

    public function getObjParque(){
        return $this->objParque;
    }
    public function setObjParque($valor){
        $this->objParque=$valor;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion=$valor;
    }


    /**
     * Recupera los datos de un juego por codigo
     * @param int $cod
     * @return true en caso de encontrar los datos, false en caso contrario
     * 
     */

    public function Buscar($cod){
        $base = new BaseDatos();
        $sql = "SELECT * FROM juego WHERE codjuego=".$cod;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){
                    $this->setCodJuego($cod);
                    $this->setNombreJuego($row['nombrejuego']);
                    $this->setCantidadPersonas($row['cantidadpersonas']);
                    $this->setActivo($row['activo']);
                    $this->setEdad($row['edad']);
                    $this->setAltura($row['altura']);
                    $this->setMaximoPersonas($row['maximopersonas']);
                    $this->setTotalPersonas($row['totalpersonas']);

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);
                    $this->setObjParque($unParque);
                    
                    $resp= true;
				}	
            }	else {
                $this->setmensajeoperacion($base->getError());
		 		
			}
        }	else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
	}

    public function listar($condicion=""){
        $arreglo = null;
		$base=new BaseDatos();
		$sql="SELECT * FROM juego ";
		if ($condicion!=""){
            $sql=$sql.' WHERE '.$condicion;
		}
        //$sql.=" order by nombrejuego ";
        //echo $sql;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $arreglo = array();
                while($row=$base->Registro()){
                    $obj=new Juego();

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);

                    $obj->cargar($row['codjuego'],$row['nombrejuego'],$row['cantidadpersonas'],$row['activo'],$row['edad'],$row['altura'],$row['maximopersonas'],$row['totalpersonas'],$unParque);
                    array_push($arreglo,$obj);
                }
            }else {
                //$this->setmensajeoperacion($base->getError());
            }
        }	else {
            //$this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
    }


    public function insertar(){
		$base= new BaseDatos();
		$resp= false;
		$sql="INSERT INTO juego(nombrejuego, cantidadpersonas, activo,edad,altura,maximopersonas,totalpersonas,parque) 
				VALUES ('".$this->getNombreJuego()."','".$this->getCantidadPersonas()."',".$this->getActivo().",".$this->getEdad().",".$this->getAltura().",".$this->getMaximoPersonas().",".$this->getTotalPersonas().",".$this->getObjParque()->getIDParque().")";
		
		if($base->Iniciar()){

			if($cod = $base->devuelveIDInsercion($sql)){
                $this->setCodJuego($cod);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$sql="UPDATE juego SET nombrejuego='".$this->getNombreJuego()."',cantidadpersonas=".$this->getCantidadPersonas().",activo=".$this->getActivo().", edad=".$this->getEdad().",altura=".$this->getAltura().", maximopersonas=".$this->getMaximoPersonas().", totalpersonas=".$this->getTotalPersonas()." WHERE codjuego=".$this->getCodJuego();
		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function eliminar(){
		$base =new BaseDatos();
		$resp =false;
		if($base->Iniciar()){
				$sql="DELETE FROM juego WHERE codjuego=".$this->getCodjuego();
				if($base->Ejecutar($sql)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}


    public function __toString(){
        if($this->esActivo()){
            $resp=" Activo ";
        }else{
            $resp= " Desactivado ";
        }


        return "\nCodigo: ".$this->getCodJuego()."\nNombre Juego: ".$this->getNombreJuego()."\nEstado de actividad: ".$resp."\nEdad Permitida: ".$this->getEdad()."\nAltura permitida: ".$this->getAltura()."\nCantidad Maxima Permitida: ".$this->getMaximoPersonas()."\n Total Personas: ".$this->getTotalPersonas()."\nParque: ".$this->getObjParque()->getNombre();
    }

    public function esActivo(){
        $resp=false;
        if($this->getActivo()==1){
            $resp=true;
        }
        return $resp;
    }



    /**
     * 
     */

    public function BuscarXNombre($nombre){
        $arreglo=array();

        $base = new BaseDatos();
        $sql = "SELECT * FROM juego WHERE nombrejuego='".$nombre."'";
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    $objJuego=new Juego();

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);

                    $objJuego->cargar($row['codjuego'],$row['nombrejuego'],$row['cantidadpersonas'],$row['activo'],$row['edad'],$row['altura'],$row['maximopersonas'],$row['totalpersonas'],$unParque);

                    array_push($arreglo,$objJuego);
                    $resp= true;
				}	
            }	else {
                $this->setmensajeoperacion($base->getError());
		 		
			}
        }	else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
	}


    //editar
    /** 
     * Busca todos lo juegos activos o no
     */
    public function juegosActivos($act){
        $arreglo=array();

        $base = new BaseDatos();
        $sql = "SELECT * FROM juego WHERE activo=".$act;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while($row=$base->Registro()){
                    
                    $objJuego=new Juego();

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);

                    $objJuego->cargar($row['codjuego'],$row['nombrejuego'],$row['cantidadpersonas'],$row['activo'],$row['edad'],$row['altura'],$row['maximopersonas'],$row['totalpersonas'],$unParque);

                    array_push($arreglo,$objJuego);
                    $resp= true;
				}	
            }	else {
                $this->setmensajeoperacion($base->getError());
		 		
			}
        }	else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
	}
    


    /**
     * JugarJuego() @param $unPase @return $resp
     * cada vez que un pase ingresa se incrementa la cantidad de personas que juegan hasta llegar al maximo permitido.
     * Devolvera false si el pase no cumple con las condicines del juego
    */
    public function jugarJuego($unPase){
        $edadPermitida=$this->getEdad();
        $alturaPermitida=$this->getAltura();
        $cantPersonaAct=$this->getCantidadPersonas();
        $maxPermitida=$this->getMaximoPersonas();
        $juegosJugados=$unPase->getCantidadJuegos();
        $totalpersonas=$this->getTotalPersonas();

        $resp=true;

        if($cantPersonaAct >= $maxPermitida){
            $resp=false;
        }

        if($unPase->getVisitante()->getEdad()!=$edadPermitida || $unPase->getVisitante()->getAltura()<$alturaPermitida){
            $resp=false;   
        }

        if($resp){
            $cantPersonaAct++;
            $juegosJugados++;
            $this->setCantidadPersonas($cantPersonaAct);
            $this->setTotalPersonas();
            $unPase->setCantidadJuegos($juegosJugados);

            if($cantPersonaAct==$maxPermitida){
                 /* 0 es igual false una vez que se llega al maximo el juego se desactiva */
                $this->setActivo(0);
            }

            $this->modificar();
            $unPase->modificar();
            $resp=true;
        }
        return $resp;
    }


    /**
     * ActivarJuego() activa nuevamente el juego reiniciando tambien cantidadPersonas
     * Activo 1 es igual a true;
    */
    public function activarJuego(){
        $this->setActivo(1);
        $this->setCantidadPersonas(0);
        $this->modificar();
    }




    /**
     * ordena una lista de juegos de mayor a menor segun el total de personas
    */
    function burbuja($colJuego,$num){

        for($i=1;$i<$num;$i++){
          for($j=0;$j<$num-$i;$j++){
            
            if($colJuego[$j]->getTotalPersonas() < $colJuego[$j+1]->getTotalPersonas()){
              $k=$colJuego[$j+1]; 
              $colJuego[$j+1]=$colJuego[$j]; 
              $colJuego[$j]=$k;
            }
          }
        }
        return $colJuego;
    }

    /**
     * @param $n @return array 
     */
    public function juegosMasJugados(){
        $objJuego=new Juego();
        $coljuegos=$objJuego->listar();
        $tam=count($coljuegos);
        $listaJuego=burbuja($coljuegos,$tam);
        return $listaJuego;
    }





























    /* public function juegosMasJugados($n){
        $objJuego=new Juego();
        //$coljuegos=$objJuego->listar();
        //comparar($coljuegos);
        $coljuegos=$objJuego->listarXtotalPer();
        $arreglo=array();

        if($n<count($coljuegos)){
            for($i=0;$i<$n;$i++){
                $unJuego=$coljuegos[$i];
                array_push($arreglo,$unJuego);
            } 
        }
        /* while($i<n && $i!=count($coljuegos)){

        } 
        return $arreglo;
    } */

    
    
    /**
     * 
     * 
    */
    public function listarXtotalPer($condicion=""){
        $arreglo = null;
		$base=new BaseDatos();
		$sql="SELECT * FROM juego ";
		if ($condicion!=""){
            $sql=$sql.' WHERE '.$condicion;
		}
        $sql.=" ORDER BY totalpersonas DESC";
        //echo $sql;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $arreglo = array();
                while($row=$base->Registro()){
                    $obj=new Juego();

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);

                    $obj->cargar($row['codjuego'],$row['nombrejuego'],$row['cantidadpersonas'],$row['activo'],$row['edad'],$row['altura'],$row['maximopersonas'],$row['totalpersonas'],$unParque);
                    array_push($arreglo,$obj);
                }
            }else {
                //$this->setmensajeoperacion($base->getError());
            }
        }	else {
            //$this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
    }
}
?>