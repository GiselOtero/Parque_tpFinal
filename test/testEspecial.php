<?php
include_once "../ORM/Especial.php";
include_once "../ORM/Juego.php";

include_once "../ORM/BaseDatos.php";
include_once "../ORM/Parque.php";

$objEspecial = new Especial();

/* listar */
//Muestra una Lista de todos los Juegos Especiales almacenados en la BD
$colEspecial =$objEspecial->listar();
foreach ($colEspecial as $unEspecial){
    echo "<br>";//html
    echo $unEspecial;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}
//1400
/* Ingresar un nuevo Especial */
echo "<br>";//html
/* $unParque=new Parque();
$unParque->Buscar(1);
$objEspecial->cargar(1,"Calecita",0,1,3,120,10,0,$unParque);
$resp=$objEspecial->insertar();
if($resp){
    echo "\n OP INSERCION;  El Juego fue ingresado en la BD";
    $colEspecial=$objEspecial->listar();
    foreach ($colEspecial as $unEspecial){
        echo "<br>";//html
        echo $unEspecial;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}else{
    echo $objEspecial->getmensajeoperacion();
} */
echo "<br>";//html

/* Modificar */
//Modifico un dato de Especial
/* $unEspecial->setNombreJuego("Carrusel");
$resp2=$unEspecial->modificar();
if($resp2){
    //Busco todas los Especials almacenadas en la BD y veo la modificacion realizada
	$colEspecial =$objEspecial->listar();
	echo " \nOP MODIFICACION: Los datos fueron actualizados correctamente";
    foreach ($colEspecial as $unEspecial){
        echo "<br>";//html
        echo $unEspecial;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objEspecial->getmensajeoperacion();
} */
    

/* Eliminar */
//Elimina un Especial de la BD
/* $resp3 = $unEspecial->eliminar();
if($resp3){
    $colEspecial =$objEspecial->listar();
	echo " \nOP ELIMINACION: Los datos fueron eliminados correctamente";
    foreach ($colEspecial as $unEspecial){
        echo "<br>";//html
        echo $unEspecial;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }

}else{
    echo $objEspecial->getmensajeoperacion();
} */

/* buscar */
$colActivos=$objEspecial->juegosActivos(1);


foreach ($colActivos as $unEspecial){
    echo "<br>";//html
    echo $unEspecial;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}




?>