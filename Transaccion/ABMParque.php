<?php
//include "../datos/Parque.php";
class ABMParque{
    
    /**
     * Lista todos los parques alamacenados en la base de datos
     */
    public function listarParque(){
        
        $objParque=new Parque();
        $colParque=$objParque->listar();
        
        echo "\n---------------------------------------------\n";
        foreach ($colParque as $unParque){
            echo $unParque;
            echo "\n---------------------------------------------\n";
        }
    }


    /* ALTA */
    public function alta($datos){
        $unParque= new Parque();
        $unParque->cargar(1,$datos["nombre"],$datos["razonsocial"],$datos["domicilio"]);
        if($unParque->insertar()){
            echo "\nLos datos fueron cargados correctamente\n";
        }else{
            echo "\nHubo un error al cargar los datos\n";
        }

    }
    /* ALTA */



    /* MODIFICAR */

    /**
     * SOlo modifica razon social ingrtesa por parametro un parque 
     * y muestra por pantalla si se pudo modificar
     */
    public function modificarRazonSocial($objParque,$dato){

        $objParque->setRazonSocial($dato);
        if($objParque->modificar()){
            echo "\nLos datos fueron modificados correctamente\n";
        }else{
            echo "\nHubo un error al modificar los datos\n";
        }
    }

    /* mODIFICAR */



    /* BAJA */
    /**
     * Elimina de la base de datos el parque que es ingresado por parametro
     */
    Public function bajaParque($objParque){
        $resp=$objParque->eliminar();
        if($resp){
            echo "\nse elimino correctamente\n";
        }else{
            echo "\nEl parque no se elimino correctamente\n";
        }

    }

    


    /* public function buscar($id){
        $objParque=new Parque();
        $objParque->Buscar($id);
        return $objParque;
    } */

    /*  */
    public function buscar($id){
        $objParque=new Parque();
        $encontrado=$objParque->Buscar($id);
        if(!$encontrado){
            $objParque=null;
        }
        return $objParque;
    }

    public function existeID($iD){
        $objParque=new Parque();
        $encontrado=$objParque->Buscar($id);
        return $encontrado;
    }
}
?>