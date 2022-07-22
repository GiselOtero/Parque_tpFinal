<?php
class ABMVisitante{

    public function listarVisitante(){
        $objVisitante=new Visitante();
        $colVisitante=$objVisitante->listar();
       
       echo "\n---------------------------------------------\n";
       foreach ($colVisitante as $unVisitante){
           
           echo $unVisitante;
           echo "\n---------------------------------------------\n";
       }
    }
    
    /* ALta */
    //crea un nuevo visitante
    public function alta($datos){ 
        $unVisitante= new Visitante();
        $edad=$unVisitante->calcularEdad($datos['fechaNac']);
        echo "edad ".$edad;
        $unVisitante->cargar(1,$datos['nombre'],$datos['apellido'],$datos['fechaNac'],$edad,$datos['altura'],$datos['tipodoc'],$datos['nrodoc']);

        if($unVisitante->insertar()){
            echo "\nLos datos fueron cargados correctamente\n";
        }else{
            echo "\nHubo un error al cargar los datos\n";
        }
    }
    /* ALTA */


    /* MODIFICAR */
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
        
        $colVisitanteNom=$objVisitante->buscarXNombre($nombre);
        if(count($colVisitanteNom)<=0){
            echo "\nNo se ha encontrado datos almacenados\n";
        }else{
            echo "\n---------------------------------------------\n";
            foreach ($colVisitanteNom as $unVisitante){
                
                echo $unVisitante;
                echo "\n---------------------------------------------\n";
            }
        }
    }
    /* public function existeDni($dni){
        $objVisitante=new Visitante();
        
        $encontrado=$objVisitante->BuscarXDni($dni);
            
        return $encontrado;
    } */
}
?>