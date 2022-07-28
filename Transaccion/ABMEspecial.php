<?php
class ABMEspecial{
    public function listarJuegoEspecial(){
        $objEspecial=new Especial();
        $colEspecial=$objEspecial->listar();
       
       echo "\n**********************************\n";
       foreach ($colEspecial as $unEspecial){
           
           echo $unEspecial;
           echo "\n**********************************\n";
       }
    }

    /* ALTA */
    public function altaEspecial($datos){
        $objEspecial= new Especial();
        $objEspecial->cargar(1,$datos['nombrejuego'],0,$datos['activo'],$datos['edad'],$datos['altura'],$datos['max'],0,$datos['unparque']);
        
        $resp=$objEspecial->insertar();
        return $resp;
        
    }
    /* ALTA */

    /* MODIFICAR */
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
    /* MODIFICAR */


    /* BAJA */
    public function bajaEspecial($objEspecial){
        $resp=$objEspecial->eliminar();
        if($resp){
            echo "\nse elimino correctamente\n";
        }else{
            echo "\nEl Visitante no se elimino correctamente\n";
        }
    }
    /* BAJA */


    /* buscar */

    public function buscarCod($cod){
        $objEspecial= new Especial();
        $encontrado=$objEspecial->Buscar($cod);
        if(!$encontrado){
            $objEspecial=null;
        }
        return $objEspecial;
    }

    public function buscarXnombre($nombre){
        $objEspecial=new Especial();
        $condicion=" nombrejuego= '".$nombre."'";
        $colBuscar=$objEspecial->listar($condicion);
        return $colBuscar;
    }

    public function buscarXactivo($activo){
        $objEspecial=new Especial();
        $condicion=" activo=".$activo;
        $colBuscar=$objEspecial->listar($condicion);
        return $colBuscar;
    }
    /* buscar */

    /* Jugar */


    /*  */
    public function masJugadosEspecial($n){
        $objEspecial=new Especial();
        $colJuegos=$objEspecial->juegosMasJugados();
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