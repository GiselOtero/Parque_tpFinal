<?php
include_once "../ORM/Visitante.php";

$objVisitante = new Visitante();


/* Listar */
//Muestra una Lista de todos los Visitantes almacenados en la BD
$colVisitante =$objVisitante->listar();
foreach ($colVisitante as $unVisitante){
    echo "<br>";//html
    echo $unVisitante;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}



/* Ingresar un nuevo Visitante */
echo "<br>";//html

$objVisitante->cargar(2,"Tomas","Perez","1999-10-24",22,1.79,"dni",41236765);
/* $resp=$objVisitante->insertar();
if($resp){
    echo "\n OP INSERCION;  La persona fue ingresada en la BD";
    $colVisitante=$objVisitante->listar();
    foreach ($colVisitante as $unVisitante){
        echo "<br>";//html
        echo $unVisitante;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}else{
    echo $objVisitante->getmensajeoperacion();
} */
echo "<br>";//html


/* Modificar */
//Modifico un dato de Visitante
/* $objVisitante->setNombre("Nombre Modificado");
$resp2=$objVisitante->modificar();
if($resp2){
    //Busco todas los Visitantes almacenadas en la BD y veo la modificacion realizada
	$colVisitante =$objVisitante->listar();
	echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
    foreach ($colVisitante as $unVisitante){
        echo "<br>";//html
        echo $unVisitante;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objVisitante->getmensajeoperacion();
} */
    

/* Eliminar */
//Elimina un Visitante de la BD
/* $resp3 = $unVisitante->eliminar();
if($resp3){
    $colVisitante =$objVisitante->listar();
	echo " \nOP ELIMINACION: Los datos fueron eliminados correctamente";
    foreach ($colVisitante as $unVisitante){
        echo "<br>";//html
        echo $unVisitante;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objVisitante->getmensajeoperacion();
} */


/* Buscar por nombre */

$colVisitante= $objVisitante->BuscarXNombre("Alexander");
if(count($colVisitante)>0){

    foreach ($colVisitante as $unVisitante){
        echo "<br>";//html
        echo $unVisitante;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}else{
    echo "no se encontro datos almacenados";
}

/* buscar */
$fecha="2022-05-07";
$num=5;
$condicion1=" fechaemision='".$fecha."'";
$condicion2=" cantidadjuegos=".$num;
$colPaseF=$objPase->BuscarXCondicion($condicion2);
if(count($colPaseF)<=0){
    echo "\nNo se ha encontrados datos almacenados\n";
}else{
    foreach ($colPaseF as $unPase){
        echo "<br>";//html
        echo $unPase;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}

?>