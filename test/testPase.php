<?php
include_once "../ORM/Pase.php";
include_once "../ORM/Visitante.php";
include_once "../ORM/Parque.php";


$objPase = new Pase();

/* Listar */
//Muestra una Lista de todos los Pases almacenados en la BD
$colPase =$objPase->listar();
//$utiles->mostrarColeccion($colPase);
foreach ($colPase as $unPase){
    echo "<br>";//html
    echo $unPase;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}



/* Ingresar un nuevo Pase */
echo "<br>";//html
/* 
$unVisitante=new Visitante();
$unVisitante->Buscar(3);

$objPase->cargar(1,$unVisitante,"2022-02-17",5,0);
$resp=$objPase->insertar();
if($resp){
    echo "\nOP INSERCION;  La persona fue ingresada en la BD";
    $colPase=$objPase->listar();
    foreach ($colPase as $unPase){
        echo "<br>";//html
        echo $unPase;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
} */
echo "<br>";//html



/* Modificar */
//Modifico un dato de Pase
/* $objPase->setConAptitud(1);
$resp2=$objPase->modificar();
if($resp2){
    //Busco todas los Pases almacenadas en la BD y veo la modificacion realizada
	$colPase =$objPase->listar();
	echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
    foreach ($colPase as $unPase){
        echo "<br>";//html
        echo $unPase;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objPase->getmensajeoperacion();
} */
    

/* Eliminar */
//Elimina un Pase de la BD
/* $resp3 = $unPase->eliminar();
if($resp3){
    $colPase =$objPase->listar();
	echo " \nOP ELIMINACION: Los datos fueron eliminados correctamente";
    foreach ($colPase as $unPase){
        echo "<br>";//html
        echo $unPase;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objPase->getmensajeoperacion();
} */



?>