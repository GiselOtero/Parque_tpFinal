<?php
class ABMVisitante{


    /**
     * Muestra la lista completa de todos los visitantes
     * 
     */
    public function listarVisitante(){
        $objVisitante=new Visitante();
        $colVisitante=$objVisitante->listar();
       
       echo "\n**********************************\n";
       foreach ($colVisitante as $unVisitante){
           
           echo $unVisitante;
           echo "\n**********************************\n";
       }
    }
    
    /* ALta */
    //crea un nuevo visitante
    public function alta($datos){ 
        $unVisitante= new Visitante();

        if($this->buscarXDni($datos['nrodoc'])!=null){
            echo "\nEl numero de Dni ya esta almacenado en la base de datos\n";
        }else{

            $edad=$unVisitante->calcularEdad($datos['fechaNac']);
            //echo "edad ".$edad;
            $unVisitante->cargar(1,$datos['nombre'],$datos['apellido'],$datos['fechaNac'],$edad,$datos['altura'],$datos['tipodoc'],$datos['nrodoc']);
            if($unVisitante->insertar()){
                echo "\nLos datos fueron cargados correctamente\n";
            }else{
                echo "\nHubo un error al cargar los datos\n";
            }
            
        }
    }
    /* ALTA */


    /* MODIFICAR */
    /**
     * Modifica Nombre y apellido del visitante
     */
    public function modificarNombreApellido($objVisitante,$datos){
        $objVisitante->setNombre($datos['nombre']);
        $objVisitante->setApellido($datos['apellido']);
        if($objVisitante->modificar()){
            echo "\nLos datos fueron modificados correctamente\n";
        }else{
            echo "\nHubo un error al modificar los datos\n";
        }
    }
    /* MODIFICAR */

    /* BAJA */
    Public function bajaVisitante($objVisitante){
        $resp=$objVisitante->eliminar();
        if($resp){
            echo "\nse elimino correctamente\n";
        }else{
            echo "\nEl Visitante no se elimino correctamente\n";
        }

    }
    /* BAJA */


    /**
     * Busca un visitante por número de dni retorna si existe el visitante en la base de datos 
     * retorna el objeto, en caso contrario devuelve nulo. 
     */
    public function buscarXDni($dni){
        $objVisitante=new Visitante();
        
        $encontrado=$objVisitante->BuscarXDni($dni);
        if(!$encontrado){
            $objVisitante=null;
        }
        //echo "\nabm buscar ".$objVisitante."\n";
        return $objVisitante;
    }

    public function buscarXNombre($nombre){
        $objVisitante=new Visitante();
        $condicion=" nombre='".$nombre."' ";
        $colVisitanteNom=$objVisitante->listar($condicion);
        if(count($colVisitanteNom)<=0){
            echo "\nNo se ha encontrado datos almacenados\n";
        }else{
            $this->mostrarDatos($colVisitanteNom);
        }
    }
    /* public function existeDni($dni){
        $objVisitante=new Visitante();
        
        $encontrado=$objVisitante->BuscarXDni($dni);
            
        return $encontrado;
    } */


    /**
     * Muestra por pantalla la colección ingresada por parámetros
     * @param array $unaColeccion
     */
    public function mostrarDatos($unaColeccion){
        $tam=count($unaColeccion);
        if($tam<=0){
            echo "\nNo se ha encontrado datos almacenados\n";
        }else{
            echo "\n**********************************\n";
            foreach ($unaColeccion as $unElemento){       
            echo $unElemento;
            echo "\n**********************************\n";
            }
        }
    }
}
?>