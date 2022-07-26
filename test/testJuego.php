<?php
include_once "../ORM/Juego.php";

include_once "../ORM/BaseDatos.php";
include_once "../ORM/Parque.php";
include_once "../ORM/Pase.php";
include_once "../ORM/Visitante.php";




$objJuego = new Juego();

/* listar */
//Muestra una Lista de todos los Juegos Juegoes almacenados en la BD
$colJuego =$objJuego->listar();
foreach ($colJuego as $unJuego){
    echo "<br>";//html
    echo $unJuego;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}
echo "<br>";//html



/* buscar */
/* $colActivos=$objJuego->juegosActivos(1);

foreach ($colActivos as $unJuego){
    echo "<br>";//html
    echo $unJuego;
    
    echo "<br>";//html
    echo "\n-------------------------------------------------------\n";
}
echo "<br>";//html
echo "<br>";//html */


/* buscar */
/* $colXnombre=$objJuego->BuscarXNombre("");


if(count($colXnombre)>0){

    foreach ($colXnombre as $unJuego){
        echo "<br>";//html
        echo $unJuego;
        
        echo "<br>";//html
        echo "\n-------------------------------------------------------\n";
    }
}else{
    echo "no se encontro datos almacenados";
} */
/* $UnPase=new Pase();
$UnPase->Buscar(3);
$objJuego->Buscar(6);
//$resp=;
echo "\n".$objJuego;
if($objJuego->jugarJuego($UnPase)){
    echo "<br>";
    echo "Juego";
}else{
    echo "<br>";
    echo "no puede subir al juego";
} */


