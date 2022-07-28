<?php
class ABMPase{
    
    /* Listar */
    function listarPase(){
        $objPase=new Pase();
        $colPase=$objPase->listar();
       
       echo "\n**********************************\n";
       foreach ($colPase as $unPase){
           echo $unPase;
           echo "\n**********************************\n";
       }
    }
    /* listar */


    /* ALTA */
    function alta($datos){
        $objPase=new Pase();
        $objPase->cargar(1,$datos['visitante'],$datos['fechaemision'],$datos['cantidadjuegos'],$datos['conaptitud'],$datos['parque']);

        if($objPase->insertar()){
            echo "\nLos datos fueron cargados correctamente\n";
        }else{
            echo "\nHubo un error al cargar los datos\n";
        }
        
    }
    /* ALTA */

    
    /* MODIFICAR */
    function modificarAptitud($unPase,$dato){
        //$objPase= new Pase();
        $unPase->setConAptitud($dato);
        
        if($unPase->modificar()){
            echo "\nLos datos fueron modificados correctamente\n";
        }else{
            echo "\nHubo un error al modificar los datos\n";
        }
    }

    function modificarCantJuego($unPase,$dato){
        //$unPase= new Pase();
        $unPase->setCantidadJuegos($dato);
        
        if($unPase->modificar()){
            echo "\nLos datos fueron modificados correctamente\n";
        }else{
            echo "\nHubo un error al modificar los datos\n";
        }
    }
    /* MODIFICAR */

    /* BAJA */
    public function bajaPase($unPase){
        $resp=$unPase->eliminar();
        if($resp){
            echo "\nEl pase se elimino correctamente\n";
        }else{
            echo "\nEl pase no se elimino correctamente\n";
        }
    }
    /* BAJA */



    /* BUSCAR */
   /*  public function buscarXID($id){
        $objPase=new Pase();
        $objPase->Buscar($id);
        return $objPase;
    } 
    public function existeID($id){
        $objPase=new Pase();
        
        $encontrado=$objPase->Buscar($id);
            
        return $encontrado;
    } */


    public function buscarXID($id){
        $objPase=new Pase();
        $encontrado=$objPase->Buscar($id);
        if(!$encontrado){
            $objPase=null;
        }
        return $objPase;
    }

    public function buscarXFecha($dato){
        $objPase=new Pase();
        $condicion= "fechaemision= '".$dato."'";
        $colPase=$objPase->listar($condicion);
        if(count($colPase)<=0){
            echo "\nNo se ha encontrado datos almacenados\n";
        }else{
            $this->mostrarDatos($colPase);
        }
    }

    public function buscarXCantidad($dato){
        $objPase=new Pase();
        $condicion=" cantidadjuegos=".$dato;
        $colPase=$objPase->listar($condicion);
        if(count($colPase)<=0){
            echo "\nNo se ha encontrados datos almacenados\n";
        }else{
            
            $this->mostrarDatos($colPase);
        }
    }
    /* BUSCAR */

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