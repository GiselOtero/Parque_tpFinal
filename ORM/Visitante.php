<?php
include_once "BaseDatos.php";
class Visitante{
    private $idVisitante;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $edad;
    private $altura;
    private $tipoDoc;
    private $nroDoc;
    private $mensajeoperacion;

    public function __construct(){
        $this->idVisitante="";
        $this->nombre="";
        $this->apellido="";
        $this->fechaNacimiento="";
        $this->edad="";
        $this->altura="";
        $this->tipoDoc="";
        $this->nroDoc="";
    }


    public function cargar($id,$nombre,$apellido,$fechanac,$edad,$altura,$tipoDoc,$nrod){
        $this->setIDVisitante($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setFechaNacimiento($fechanac);
        //$edad = $this->calcularEdad($fechaNac);
        $this->setEdad($edad);
        $this->setAltura($altura);
        $this->setTipoDoc($tipoDoc);
        $this->setNroDoc($nrod);
    }

    public function getIDVisitante(){
        return $this->idVisitante;
    }
    public function setIDVisitante($valor){
        $this->idVisitante=$valor;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($valor){
        $this->nombre=$valor;
    }

    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($valor){
        $this->apellido=$valor;
    }

    public function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($valor){
        $this->fechaNacimiento=$valor;
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

    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function setTipoDoc($valor){
        $this->tipoDoc=$valor;
    }

    public function getNroDoc(){
        return $this->nroDoc;
    }
    public function setNroDoc($valor){
        $this->nroDoc=$valor;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion=$valor;
    }


    /**
     * Recupera los datos de un visitante por su id
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id){
        $base = new BaseDatos();
        $sql = "SELECT * FROM visitante WHERE idvisitante=".$id;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){
                    $this->setIDVisitante($id);
                    $this->setNombre($row['nombre']);
                    $this->setApellido($row['apellido']);
                    $this->setFechaNacimiento($row['fechanacimiento']);
                    $this->setEdad($row['edad']);
                    $this->setAltura($row['altura']);
                    $this->setTipoDoc($row['tipodoc']);
                    $this->setNroDoc($row['nrodoc']);
                    $resp= true;
                }
            }else {
                $this->setmensajeoperacion($base->getError());
            }
        }else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
	}

    /**
     * Retorna un array con los visitantes que cumplan con una condición, en caso de no tener condición 
     * retorna todos los visitantes que se encuentran almacenados en la base de datos
     * @param string $condicion
     * @return array
    */
    public static function listar($condicion=""){
        $arreglo = null;
        $base=new BaseDatos();
		$sql="SELECT * FROM visitante ";
		if ($condicion!=""){
            $sql.=' WHERE '.$condicion;
		}
        //$sql.=" order by nombre ";
        //echo $sql;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $arreglo = array();
                while($row=$base->Registro()){
                    $obj=new Visitante();
                    $obj->cargar($row['idvisitante'],$row['nombre'],$row['apellido'],$row['fechanacimiento'],$row['edad'],$row['altura'],$row['tipodoc'],$row['nrodoc']);
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
     * Inserta un visitante en la base de datos,
     * retorna true si el dato se insertó correctamente, false en caso contrario
     * @param 
     * @return boolean $resp
     */
    public function insertar(){
        $base=new BaseDatos();
        $resp= false;
        

        $sql="INSERT INTO visitante(nombre, apellido, fechanacimiento,edad,altura,tipodoc,nrodoc) VALUES ('".$this->getNombre()."','".$this->getApellido()."','".$this->getFechaNacimiento()."',".$this->getEdad().",".$this->getAltura().",'".$this->getTipoDoc()."',".$this->getNroDoc().")";

        if($base->Iniciar()){
            if($id = $base->devuelveIDInsercion($sql)){
                $this->setIDVisitante($id);
                $resp=  true;
            }else {
                $this->setmensajeoperacion($base->getError());
                }
            } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    /**
     * Modifica un dato de un Visitante, 
     * retorna true si el dato se modificó correctamente false en caso contrario
     * @param 
     * @return boolean $resp
     */
    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$sql="UPDATE visitante SET nombre='".$this->getNombre()."',apellido='".$this->getApellido()."' ,fechanacimiento='".$this->getFechaNacimiento()."', edad= ".$this->getEdad().", altura= ".$this->getAltura().", tipodoc='".$this->getTipoDoc()."', nrodoc=".$this->getNroDoc()." WHERE idvisitante=".$this->getIDVisitante();
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
     * Elimina un Visitante almacenado en la base de datos, 
     * retorna true si el dato se eliminó correctamente false en caso contrario
     * @return boolean $resp
     */
    public function eliminar(){
        $base =new BaseDatos();
        $resp =false;
        if($base->Iniciar()){
            $sql="DELETE FROM visitante WHERE idvisitante=".$this->getIDVisitante();
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
     * Retorna un String con la información de visitante
     * @return string
     */
    public function __toString(){
        return "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido()."\nFechaNacimiento: ".$this->getFechaNacimiento()."\nEdad: ".$this->getEdad()."\nAltura: ".$this->getAltura()."\nTipo documento: ".$this->getTipoDoc()."\nNro doc: ".$this->getNroDoc()."\n";
    }


    /* */

    /**
     * Recupera los datos de un visitante por dni
     * @param int $dni
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function BuscarXDni($dni){
        $base = new BaseDatos();
        $sql = "SELECT * FROM visitante WHERE nrodoc=".$dni;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row=$base->Registro()){
                    /* $objVisitante= new Visitante();

                    $objVisitante->cargar($row['idvisitante'],$row['nombre'],$row['apellido'],$row['fechanacimiento'],$row['edad'],$row['altura'],$row['tipodoc'],$row['nrodoc']); */
                    $this->setIDVisitante($row['idvisitante']);
                    $this->setNombre($row['nombre']);
                    $this->setApellido($row['apellido']);
                    $this->setFechaNacimiento($row['fechanacimiento']);
                    $this->setEdad($row['edad']);
                    $this->setAltura($row['altura']);
                    $this->setTipoDoc($row['tipodoc']);
                    $this->setNroDoc($row['nrodoc']);
                    $resp= true;
                }
            }else {
                $this->setmensajeoperacion($base->getError());
            }
        }else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
	}


    


    /* calcula edad */
    /* public function calcularEdad(){
        $fechaNac= new DateTime($this->getFechaNacimiento);
        $fechaAct= new DateTime();
        $edad = $fechaAct->diff($fechaNac);
    } */

    /**
     * Calcula la edad según la fecha de nacimiento ingresada por parámetro
     * retornando la edad
     * @param $fecha
     * @return int $edad 
     */
    public function calcularEdad($fecha){
        $fechaNac= new DateTime($fecha);
        $fechaAct= new DateTime();
        // diff(fecha) Devuelve la diferencia entre dos objetos DateTime
        $edad = $fechaNac->diff($fechaAct);
        return $edad->format('%y');
    }
}
?>