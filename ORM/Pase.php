<?php
include_once "BaseDatos.php";
class Pase{
    private $idPase;
    //private $foto;
    private $visitante;
    private $fechaEmision;
    private $cantidadJuegos;
    private $conAptitud;
    private $objParque;
    private $mensajaoperacion;

    public function __construct(){
        $this->idPase="";
        $this->visitante="";
        $this->fechaEmision="";
        $this->cantidadJuegos=0;
        $this->conAptitud="";
        $this->objParque="";
    }

    public function cargar($id,$unVisitante,$fechaE,$cantJuego,$conAptitud,$unParque){
        $this->setIDPase($id);
        $this->setVisitante($unVisitante);
        $this->setFechaEmision($fechaE);
        $this->setCantidadJuegos($cantJuego);
        $this->setConAptitud($conAptitud);
        $this->setObjParque($unParque);
        
    }

    public function getIDPase(){
        return $this->idPase;
    }
    public function setIDPase($valor){
        $this->idPase=$valor;
    }

    public function getVisitante(){
        return $this->visitante;
    }
    public function setVisitante($valor){
        $this->visitante=$valor;
    }

    public function getFechaEmision(){
        return $this->fechaEmision;
    }
    public function setFechaEmision($valor){
        $this->fechaEmision=$valor;
    }

    public function getCantidadJuegos(){
        return $this->cantidadJuegos;
    }
    public function setCantidadJuegos($valor){
        $this->cantidadJuegos=$valor;
    }

    public function getConAptitud(){
        return $this->conAptitud;
    }
    public function setConAptitud($valor){
        $this->conAptitud=$valor;
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
     * Recupera los datos de un Pase por id
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     * 
     */
    public function Buscar($id){
        $base = new BaseDatos();
        $sql = "SELECT * FROM pase WHERE idpase=".$id;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){

                    $unVisitante= new Visitante();
                    $unVisitante->Buscar($row['visitante']);

                    $this->setIDPase($id);
                    $this->setVisitante($unVisitante);
                    $this->setFechaEmision($row['fechaemision']);
                    $this->setCantidadJuegos($row['cantidadjuegos']);
                    $this->setConAptitud($row['conaptitud']);

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


    /**
     * Retorna un array con los Pases que cumplan con una condición, en
     * caso de no tener condición retorna todos los Pases que se encuentran
     * almacenados en la base de datos
     * @param string $condicion
     * @return array $arreglo
    */

    public static function listar($condicion=""){
        $arreglo = null;
		$base=new BaseDatos();
		$sql="SELECT * FROM pase ";
		if ($condicion!=""){
            $sql=$sql.' WHERE '.$condicion;
		}
        //$sql.=" order by id ";
        //echo $sql;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $arreglo = array();
                while($row=$base->Registro()){
                    $obj= new Pase();

                    $unVisitante= new Visitante();
                    $unVisitante->Buscar($row['visitante']);

                    $unParque=new Parque();
                    $unParque->Buscar($row['parque']);
                    

                    $obj->cargar($row['idpase'],$unVisitante,$row['fechaemision'],$row['cantidadjuegos'],$row['conaptitud'],$unParque);
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

    /**
     * Inserta un Pase en la base de datos,
     * retorna true si el dato se insertó correctamente, false en caso contrario
     * @param 
     * @return boolean $resp
     */

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$sql="INSERT INTO pase(visitante, fechaemision, cantidadjuegos,conaptitud,parque) VALUES (".$this->getVisitante()->getIDVisitante().",'".$this->getFechaEmision()."',".$this->getCantidadJuegos().",".$this->getConAptitud().",".$this->getObjParque()->getIDParque().")";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($sql)){
                $this->setIDPase($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    /**
     * Modifica un dato de un Pase,
     * retorna true si el dato se modificó correctamente false en caso contrario
     * @param
     * @return boolean $resp
     */

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$sql="UPDATE pase SET fechaemision='".$this->getFechaEmision()."',cantidadjuegos=".$this->getCantidadJuegos()." ,conaptitud=".$this->getConAptitud()." WHERE idpase=".$this->getIDPase();
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


    /**
     * Elimina un Pase almacenado en la base de datos,
     * retorna true si el dato se eliminó correctamente false en caso contrario
     * @return boolean $resp
     */

    public function eliminar(){
		$base =new BaseDatos();
		$resp =false;
		if($base->Iniciar()){
				$sql="DELETE FROM pase WHERE idpase=".$this->getIDPase();
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

    /**
     * Retorna un String con la información de un Pase
     * @return string
     */
    public function __toString(){
        if($this->esConAptitud()){
            $resp=" true ";
        }else{
            $resp= " false ";
        }

        return "\nPASE ID: ".$this->getIDPase(). "\nVisitante: ".$this->getVisitante()->getNombre()." ".$this->getVisitante()->getApellido()."\n FechaEmision: ".$this->getFechaEmision()."\n Cantidad de juegos: ".$this->getCantidadJuegos()."\n Es con aptitud: ".$resp."\n";
    }

    
    /** 
     * esConAptitud() devuelve true si el pase es 1 o false si es cero
     * @return boolean $resp
     */
    public function esConAptitud(){
        $resp=false;
        if($this->getConAptitud()==1){
            $resp=true;
        }
        return $resp;
    }




    
}
?>