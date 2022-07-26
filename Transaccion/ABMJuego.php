<?php
class ABMJuego{

    /* listar */
    public function listarJuegos(){
        $objJuegos=new Juego();
        $colJuegos=$objJuegos->listar();
       
       echo "\n**********************************\n";
       foreach ($colJuegos as $unJuegos){
           
           echo $unJuegos;
          echo "\n**********************************\n";
       }
    }

   /*  public function listarJuegoExtremo(){
        $objExtremo=new Extremo();
        $colExtremo=$objExtremo->listar();
       
      echo "\n**********************************\n";
       foreach ($colExtremo as $unExtremo){
           
           echo $unExtremo;
          echo "\n**********************************\n";
       }
    } */

    /* public function listarJuegoEspecial(){
        $objEspecial=new Especial();
        $colEspecial=$objEspecial->listar();
       
      echo "\n**********************************\n";
       foreach ($colEspecial as $unEspecial){
           
           echo $unEspecial;
          echo "\n**********************************\n";
       }
    } */

    /* ALTA */
    
    public function altaJuego($datos){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo=new ABMExtremo();

        $resp=false;
        if($datos['tipojuego']==1){
            $resp= $abmJuegoEspecial->altaEspecial($datos);
        }
        if($datos['tipojuego']==2){
            $resp=$abmJuegoExtremo->altaExtremo($datos);
        }

        if($resp){
            echo "\nLos datos fueron cargados correctamente\n";
        }else{
            echo "\nHubo un error al cargar los datos\n";
        }
    }

    /* public function altaExtremo($datos){
       $objExtremo= new Extremo();
       $objExtremo->cargar(1,$datos['nombrejuego'],0,$datos['activo'],$datos['edad'],$datos['altura'],$datos['max'],0,$datos['unparque']);
       $resp=$objExtremo->insertar();
       return $resp;
    }

    public function altaEspecial($datos){
        $objEspecial= new Especial();
        $objEspecial->cargar(1,$datos['nombrejuego'],0,$datos['activo'],$datos['edad'],$datos['altura'],$datos['max'],0,$datos['unparque']);

        $resp=$objEspecial->insertar();
        return $resp;
    } */

    /* ALTA */

    /* BAJA */
    public function bajaJuego($unJuego){
        $resp=$unJuego->eliminar();
        if($resp){
            echo "\nEl pase se elimino correctamente\n";
        }else{
            echo "\nEl pase no se elimino correctamente\n";
        }
    }
    /* BAJA */

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
    
    /* buscar */
    public function buscar($cod){
        $objJuego= new Juego();
        $encontrado=$objJuego->Buscar($cod);
        if(!$encontrado){
            $objJuego=null;
        }
        return $objJuego;
    }



    /**
     * Busca el juego por tipo(Extremo, Especial) segun el codigo
     * @param int $tipo,$cod
     * @return $unJuego
     * 
     */
    public function buscarXcodigo($tipo,$cod){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo=new ABMExtremo();

        if($tipo==1){
            $unJuego= $abmJuegoEspecial->buscarCod($cod);
        }
        if($tipo==2){
            $unJuego=$abmJuegoExtremo->buscarCod($cod);
        }
        return $unJuego;
    }

    /**
     * Busca el juego por tipo(Extremo, Especial) segun el nombre
     * @param int $tipo, string $nombreJuego
     * 
     */
    public function buscarXNombre($tipo,$nombreJuego){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo=new ABMExtremo();

        if($tipo==1){
            $colJuego= $abmJuegoEspecial->buscarXNombre($nombreJuego);
        }
        if($tipo==2){
            $colJuego=$abmJuegoExtremo->buscarXNombre($nombreJuego);
        }
        
        $this->mostrarDatos($colJuego);
        
        //return $colJuego;
    }

    /**
     * Busca el juego por tipo(Extremo, Especial) segun si esta activo o no
     * @param int $tipo,$esActivo
     * 
     */
    public function buscarXactivo($tipo,$esActivo){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo=new ABMExtremo();

        if($tipo==1){
            $colJuego= $abmJuegoEspecial->buscarXactivo($esActivo);
        }
        if($tipo==2){
            $colJuego=$abmJuegoExtremo->buscarXactivo($esActivo);
        }

        $this->mostrarDatos($colJuego);

        //return $colJuego;
    }


    /**
     * 
     */
    public function juegosMasJugados($n){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo= new ABMExtremo();
        $colEspecial=$abmJuegoEspecial->masJugadosEspecial($n);
        $colExtremo=$abmJuegoExtremo->masJugadosExtremo($n);
        $colMasJugado['especial']=$colEspecial;
        $colMasJugado['extremo']=$colExtremo;
        

        return $colMasJugado;
    }

    public function juegoMasJugadoXtipo($tipo){
        $abmJuegoEspecial=new ABMEspecial();
        $abmJuegoExtremo=new ABMExtremo();

        if($tipo==1){
            $unJuego= $abmJuegoEspecial->masJugadosEspecial(1);
        }
        if($tipo==2){
            $unJuego=$abmJuegoExtremo->masJugadosExtremo(1);
        }
        return $unJuego;
    }
    


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



    /**
     * 
     */
    public function iniciarJuego($unPase,$unJuego){
        if($unJuego->getActivo()==0){
            echo "\nEl juego no se encuentra activo\n";
        }else{
            $resp=$unJuego->jugarJuego($unPase);
            echo "\n".$resp['motivo'];
        }

    }


    public function activarJuego($unJuego){
        if($unJuego->getActivo()==1){
            echo "\nEl juego ya se encuentra activo\n";
        }else{
            $resp=$unJuego->activar();
        }

        if($resp){
            echo  "\nEl juego se activo correctamente\n";
        }else{
            echo  "\nEl juego no se activo correctamente\n";
        }
    }
}
?>