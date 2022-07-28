<?php
class ABMExtremo{
    public function listarJuegoExtremo(){
        $objExtremo=new Extremo();
        $colExtremo=$objExtremo->listar();
       
       echo "\n**********************************\n";
       foreach ($colExtremo as $unExtremo){
           
           echo $unExtremo;
           echo "\n**********************************\n";
       }
    }

    /* ALTA */
    public function altaExtremo($datos){
        $objExtremo= new Extremo();
        $objExtremo->cargar(1,$datos['nombrejuego'],0,$datos['activo'],$datos['edad'],$datos['altura'],$datos['max'],0,$datos['unparque']);
        $resp=$objExtremo->insertar();
        return $resp;
    }
    /* ALTA */

    /* MODIFICACION */
    public function modificar($objJuego,$datos){
        $objJuego->setNombreJuego($datos['nombre']);
        $objJuego->setEdad($datos['edad']);
        $objJuego->setAltura($datos['altura']);
        $objJuego->setMaximoPersonas($datos['max']);
        if($objJuego->modificar()){
            echo "\nLos datos fueron modificados correctamente\n";
        }else{
            echo "\nHubo un error al modificar los datos\n";
        }
    }
    /* MODIFICACION */

    /* BAJA */
    public function bajaExtremo($objExtremo){
        $resp=$objExtremo->eliminar();
        if($resp){
            echo "\nse elimino correctamente\n";
        }else{
            echo "\nEl Visitante no se elimino correctamente\n";
        }
    }
    /* BAJA */


    /* buscar */

    public function buscarCod($cod){
        $objExtremo= new Extremo();
        $encontrado=$objExtremo->Buscar($cod);
        if(!$encontrado){
            $objExtremo=null;
        }
        return $objExtremo;
    }

    public function buscarXnombre($nombre){
        $objExtremo=new Extremo();
        $condicion=" nombrejuego= '".$nombre."'";
        $colBuscar=$objExtremo->listar($condicion);
        return $colBuscar;
    }

    public function buscarXactivo($activo){
        $objExtremo=new Extremo();
        $condicion=" activo=".$activo;
        $colBuscar=$objExtremo->listar($condicion);
        return $colBuscar;
    }
    /* buscar */

    
    /*  */
    public function masJugadosExtremo($n){
        $objExtremo=new Extremo();
        $colJuegos=$objExtremo->juegosMasJugados();
        $tam=count($colJuegos);

        if($n==1){
            $coleccion=$colJuegos[0];
        }else if($n>=$tam){
            $coleccion=$colJuegos;
        }else{
            $coleccion=array();
            for($i=0;$i<$n;$i++){
                $coleccion[$i]=$colJuegos[$i];
            }
        }
        

        return $coleccion;
    }
}
?>