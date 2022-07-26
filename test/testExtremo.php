<?php
include_once "../ORM/Extremo.php";
include_once "../ORM/Juego.php";

include_once "../ORM/BaseDatos.php";
include_once "../ORM/Parque.php";

$objExtremo = new Extremo();

/* listar */
//Muestra una Lista de todos los Juegos Extremoes almacenados en la BD
$colExtremo =$objExtremo->listar();
foreach ($colExtremo as $unExtremo){
    echo "<br>";//html
    echo $unExtremo;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}
//1400
/* Ingresar un nuevo Extremo */
/* echo "<br>";//html
$unParque=new Parque();
$unParque->Buscar(1);
$objExtremo->cargar(1,"martillo",0,1,15,160,10,0,$unParque);
$resp=$objExtremo->insertar();
if($resp){
    echo "\n OP INSERCION;  El Juego fue ingresado en la BD";
    $colExtremo=$objExtremo->listar();
    foreach ($colExtremo as $unExtremo){
        echo "<br>";//html
        echo $unExtremo;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}else{
    echo $objExtremo->getmensajeoperacion();
} */
echo "<br>";//html

/* Modificar */
//Modifico un dato de Extremo
/* $unExtremo->setNombreJuego("Martillo 2");
$resp2=$unExtremo->modificar();
if($resp2){
    //Busco todas los Extremos almacenadas en la BD y veo la modificacion realizada
	$colExtremo =$objExtremo->listar();
	echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
    foreach ($colExtremo as $unExtremo){
        echo "<br>";//html
        echo $unExtremo;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objExtremo->getmensajeoperacion();
} */
    

/* Eliminar */
//Elimina un Extremo de la BD
$resp3 = $unExtremo->eliminar();
if($resp3){
    $colExtremo =$objExtremo->listar();
	echo " \nOP ELIMINACION: Los datos fueron eliminados correctamente";
    foreach ($colExtremo as $unExtremo){
        echo "<br>";//html
        echo $unExtremo;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objExtremo->getmensajeoperacion();
}

?>