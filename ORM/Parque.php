<?php
include_once "BaseDatos.php";
class Parque{
    private $idParque;
    private $nombre;
    private $razonSocial;
    private $domicilio;
    private $colJuego;
    private $colPasesEmitidos;
    private $mensajeoperacion;

    public function __construct(){
        $this->idParque="";
        $this->nombre="";
        $this->razonSocial="";
        $this->domicilio="";
        $this->colJuego=array();
        $this->colPasesEmitidos=array();
    }

    public function cargar($id,$nombre,$rSocial,$domicilio){
        $this->setIDParque($id);
        $this->setNombre($nombre);
        $this->setRazonSocial($rSocial);
        $this->setDomicilio($domicilio);
        /* $this->SetColJuego($colJuego);
        $this->setColPasesEmitidos($colPases); */
    }

    public function getIDParque(){
        return $this->idParque;
    }
    public function setIDParque($valor){
        $this->idParque=$valor;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($valor){
        $this->nombre=$valor;
    }

    public function getRazonSocial(){
        return $this->razonsocial;
    }
    public function setRazonSocial($valor){
        $this->razonsocial=$valor;
    }

    public function getDomicilio(){
        return $this->Domicilio;
    }
    public function setDomicilio($valor){
        $this->Domicilio=$valor;
    }

    public function getColJuego(){
        if(count($this->getColJuego()==0)){
            $idParque=$this->getIDParque();
            $colJuegos=array();
            $condicion="parque= ".$idParque;
            $objJuego=new Juego();
            $colJuegos=$objJuego->listar($condicion);
            $this->setColJuego($colJuegos);
        }
        return $this->colJuego;
    }
    public function setColJuego($valor){
        $this->colJuego=$valor;
    }

    public function getColPasesEmitidos(){
        if(count($this->getColPasesEmitidos()==0)){
            $idParque=$this->getIDParque();
            $colPases=array();
            $condicion="parque= ".$idParque;
            $objPase= new Pase();
            $colPases=$objPase->listar($condicion);
            $this->setColPasesEmitidos($colPases);
        }

        return $this->colPasesEmitidos;
    }
    public function setColPasesEmitidos($valor){
        $this->colPasesEmitidos=$valor;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion=$valor;
    }

    /**
     * Recupera los datos de un parque por id
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     * 
     */

    public function Buscar($id){
        $base = new BaseDatos();
        $sql = "SELECT * FROM parque WHERE idparque=".$id;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){
                    $this->setIDParque($id);
                    $this->setNombre($row['nombre']);
                    $this->setRazonSocial($row['razonsocial']);
                    $this->setDomicilio($row['domicilio']);
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

    public static function listar($condicion=""){
        $arreglo = null;
		$base=new BaseDatos();
		$sql="SELECT * FROM parque ";
		if ($condicion!=""){
            $sql.=' WHERE '.$condicion;
		}
        //$sql.=" order by nombre ";
        //echo $sql;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $arreglo = array();
                while($row=$base->Registro()){
                    $obj=new Parque();
                    $obj->cargar($row['idparque'],$row['nombre'],$row['razonsocial'],$row['domicilio']);
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
		$base=new BaseDatos();
		$resp= false;
		$sql="INSERT INTO parque(nombre, razonsocial, domicilio) 
				VALUES ('".$this->getNombre()."','".$this->getRazonSocial()."','".$this->getDomicilio()."')";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($sql)){
                $this->setIDParque($id);
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
		$sql="UPDATE parque SET nombre='".$this->getNombre()."',razonsocial='".$this->getRazonSocial()."' ,domicilio='".$this->getDomicilio()."' WHERE idparque=".$this->getIDParque();
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
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()){
				$sql="DELETE FROM parque WHERE idparque=".$this->getIDParque();
                //echo "-->>".$this->getIDParque();
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


    public function crearColeccion(){
        $idParque=$this->getIDParque();

        $colPases=array();
        $condicion="parque= ".$idParque;
        $objPase= new Pase();
        $objPase->listar($condicion);
        
        $colJuegos=array();
        $idParque=$this->getIDParque();
        $condicion="parque= ".$idParque;
        $objJuego=new Juego();
        $objJuego->listar($condicion);

        
    }


    public function __toString(){
        return "\nID: ".$this->getIDParque()."\n Nombre: ".$this->getNombre()."\n Razon Social: ".$this->getRazonSocial()." \n Domicilio: ".$this->getDomicilio()."\n";
        /* ."\n Coleccion de Juegos: \n".$this->getColJuego."\n Coleccion de Pases Emitidos: \n".$this->getColPasesEmitidos()."\n" */
    }


    public function agregarColeccion(){

    }
}
?>