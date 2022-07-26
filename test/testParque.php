<?php
include_once "../ORM/Parque.php";

$objParque = new Parque();

/* Listar */
//Muestra una Lista de todos los Parques almacenados en la BD
$colParque =$objParque->listar();
foreach ($colParque as $unParque){
    echo "<br>";//html
    echo $unParque;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}

/* Ingresar un nuevo Parque */
echo "<br>";//html

/* $objParque->cargar(3,"SuperParque","no se 3","Colombia 333");
$resp=$objParque->insertar(); */
/* if($resp){
    echo "\nOP INSERCION;  La persona fue ingresada en la BD";
    $colParque=$objParque->listar();
    foreach ($colParque as $unParque){
        echo "<br>";//html
        echo $unParque;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
} */
echo "<br>";//html
/* Modificar */
//Modifico un dato de Parque
/* $objParque->setNombre("Nombre Modificado");
$resp2=$objParque->modificar(); */
/* if($resp2){
    //Busco todas los Parques almacenadas en la BD y veo la modificacion realizada
	$colParque =$objParque->listar();
	echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
    foreach ($colParque as $unParque){
        echo "<br>";//html
        echo $unParque;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objParque->getmensajeoperacion();
} */
    

/* Eliminar */
//Elimina un Parque de la BD
$resp3 = $unParque->eliminar();
if($resp3){
    $colParque =$objParque->listar();
	echo " \nOP ELIMINACION: Los datos fueron eliminados correctamente";
    foreach ($colParque as $unParque){
        echo "<br>";//html
        echo $unParque;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objParque->getmensajeoperacion();
}

?>