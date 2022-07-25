<?php
include_once "ORM/Parque.php";
include_once "ORM/Juego.php";
include_once "ORM/Extremo.php";
include_once "ORM/Especial.php";
include_once "ORM/Visitante.php";
include_once "ORM/Pase.php";


include_once "Transaccion/ABMParque.php";
include_once "Transaccion/ABMJuego.php";
include_once "Transaccion/ABMEspecial.php";
include_once "Transaccion/ABMExtremo.php";
include_once "Transaccion/ABMVisitante.php";
include_once "Transaccion/ABMPase.php";



/* <<<<<<<<<<<<<<<<<<<--funciones-->>>>>>>>>>>>>>>>>>>>> */

/* function mostrarColeccion($coleccion){
    echo "\n---------------------------------------------\n";
    foreach ($coleccion as $unElemento){       
       echo $unElemento;
       echo "\n---------------------------------------------\n";
    }
} */

function esNumero(){
    $resp=false;
    do{
      $num=trim(fgets(STDIN));
      $resp=is_numeric($num);
      if(!$resp){
        echo "\nEl dato ingresado debe ser un numero(mayor a 0): ";
      }
    }while(!$resp);
    return $num;
}

/* function verificarFecha($fecha){
    $resp=false;
    if(checkdate($fecha['mes'],$fecha['dia'],$fecha['anio'])){
        $resp=true;
    }
    return $resp;
} */

function verificarFecha($mes,$dia,$anio){
    $resp=false;
    
    if(checkdate($mes,$dia,$anio)){
        $resp=true;
    }
    return $resp;
}

function ingresarFecha(){
    //$fecha=array();
    
    do{
        echo "\nIngrese Dia:  ";
        //$fecha['dia']=trim(fgets(STDIN));
        $dia=trim(fgets(STDIN));

        echo "\nIngrese mes:  ";
        //$fecha['mes']=trim(fgets(STDIN));
        $mes=trim(fgets(STDIN));

        echo "\nIngrese anio:  ";
        //$fecha['anio']=trim(fgets(STDIN));
        $anio=trim(fgets(STDIN));

        //$resp=verificarFecha($fecha);
        $resp=verificarFecha($mes,$dia,$anio);

        if(!$resp){
            echo "\nFecha Invalida\n";
        }
    }while(!$resp);

    $fecha="".$anio."-".$mes."-".$dia."";
    /* return "".$fecha['anio']."-".$fecha['mes']."-".$fecha['dia']." "; */
    return $fecha;
}

/* <<<<<<<<<<<<<<<<<<<--funciones-->>>>>>>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<--Menu principal-->>>>>>>>>>>>>>>>>>> */
function menu(){
    /* Muestra las opciones del menu */
    echo "\n-------------------<<Menu>>------------------\n";
    echo "\n1. Mostrar opcion de Parque \n";
    echo "\n2. Mostrar opcion de Juegos \n";
    echo "\n3. Mostrar opcion de Visitante \n";
    echo "\n4. Mostrar opcion de Pases\n";
    echo "\n5. Iniciar Juego\n";
    echo "\n6. Salir";
    echo "\n-------------------<<Menu>>------------------\n";
    echo "\nIngrese una opcion:  ";
    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 6){
        echo "\nIngrese nuevamente una opcion del 1 al 6:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;

}

function menuPrincipalOpcion(){
    do{
        $opcion=menu();
        switch($opcion){
            case 1:
                /* muestra el submenu de parque */
                submenuParqueOpcion();
                break;
            case 2:
                /* Muestra el submenu de Juegos */
                submenuJuegosOpcion();
                break;
            case 3:
                /* Muestra submenu Visitante */
                submenuVisitanteOpcion();
                break;
            case 4:
                submenuPasesOpcion();
                break;
            case 5:
                submenuIniciarJuegoOpcion();
                break;
        }
    }while($opcion != 6);

    echo "\nFIN DE PROGRAMA\n";
}
/* <<<<<<<<<<<<<<--fin menu principal-->>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<<<<--Parque-->>>>>>>>>>>>>>>>>>>>>>> */

function verificarParque(){
    $resp=false;
    $abmParque=new ABMParque();
    $abmParque->listarParque();
    echo "\nIngrese el id del Parque: ";
    do{
      $id=esNumero();
      $unParque=$abmParque->buscar($id);
      if($unParque==null){
        echo "\nEl dato no se encuentra almacenado ingrese nuevamete:  ";
        $resp=false;
      }else{
        $resp=true;
      }
    }while(!$resp);
    //
    //$unParque=$abmParque->buscar($id);
    echo "\n".$unParque."\n";
    return $unParque;
    //
}

/* Carga los datos nuevos en la base de datos  */
function IngresarDatos(){
    $abmParque=new ABMParque();
    echo "\nCargar datos Parque\n";
    $datos=array();
    echo "\nIngrese Nombre del Parque: ";
    $datos['nombre']=trim(fgets(STDIN));
    echo "\nIngrese RazonSocial: ";
    $datos['razonsocial']=trim(fgets(STDIN));
    echo "\nIngrese domicilio: ";
    $datos['domicilio']=trim(fgets(STDIN));

    $abmParque->alta($datos);
}

/**
 * solo modifica la razon social
 *  
 */
function modificarParque(){
    echo "\nModificar Razon Social\n";
    $unParque=verificarParque();
    $abmParque=new ABMParque();
    echo "\nIngrese la nueva Razon Social: ";
    $dato=trim(fgets(STDIN));
    $abmParque->modificarRazonSocial($unParque,$dato);
}

/* Muestra las opciones de parque */
function subMenuParque(){
    echo "\n----------------<<Menu Parque>>--------------\n";
    echo "\n1. Mostrar listado de Parque \n";
    echo "\n2. Cargar un nuevo parque \n";
    echo "\n3. Modificar datos \n";
    echo "\n4. Eliminar Parque \n";
    echo "\n5. Salir \n";
    echo "\n----------------<<Menu Parque>>--------------\n";
    echo "\nIngrese una opcion: ";

    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 5){
        echo "\nIngrese nuevamente una opcion del 1 al 5:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;
}

function submenuParqueOpcion(){
    
    $abmParque=new ABMParque();
    do{
        $opcionP=subMenuParque();
        switch($opcionP){
            case 1:
                //mostrar Listado de Parque
                $abmParque->listarParque();
                break;
            case 2:
                //ingresarDatos
                //echo "\ningresar datos\n";
                IngresarDatos();
                break;
            case 3:
                //modificar
                modificarParque();
                break;
            case 4:
                //EliminarUnParque
                $unParque=verificarParque();
                $abmParque->bajaParque($unParque);
                break;
            /* case 5:
                break; */
            
        }
    }while($opcionP!=5);
    menuPrincipalOpcion();
}
/* <<<<<<<<<<<<<<<<<<<--Parque-->>>>>>>>>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<<<<<--Juego-->>>>>>>>>>>>>>>>>>>>>>> */

function tipoJuego(){
    do{
        echo "\nEl juego es(ingrese 1 para Especial, 2 para Extremo): ";
        $tipoJuego=trim(fgets(STDIN));
        
        if($tipoJuego!=1 && $tipoJuego!=2){
            echo "\nEl dato Ingresado es incorrecto\n";
        }
    }while($tipoJuego!=1 && $tipoJuego!=2);
    return $tipoJuego;
}


function verificarJuego(){
    $resp=false;
    $abmJuego=new ABMJuego();
    $tipoJuego=tipoJuego();
    //$abmJuego->listarJuegos();
    echo "\nIngrese el codigo del Juego: ";
    do{
      $codigo=esNumero();
      $unJuego=$abmJuego->buscarXcodigo($tipoJuego,$codigo);
      if($unJuego==null){
        echo "\nEl dato no se encuentra almacenado ingrese nuevamete:  ";
        $resp=false;
      }else{
        $resp=true;
      }
    }while(!$resp);
    //
    echo "\n".$unJuego."\n";
    return $unJuego;
}

function listarJuegos(){
    $abmJuego=new ABMJuego();
    $abmJuegoEspecial=new ABMEspecial();
    $abmJuegoExtremo=new ABMExtremo();

    echo "\nMostrar Listado Juego\n"; 
    echo "\nIngrese una opcion del listado de juegos que desea ver\n";
    echo "\n1. Todos los juegos, 2. Juegos Especiales, 3. juegos Extremo: ";

    do{
        $opc=trim(fgets(STDIN));
        switch($opc){
            case 1:
               $abmJuego->listarJuegos();
                break;
            case 2:
                /* Muestra lista de juegos especiales */
                $abmJuegoEspecial->listarJuegoEspecial();
                break;
            case 3:
                /* Muestra lista de juegos extremos */
                $abmJuegoExtremo->listarJuegoExtremo();
                
                break;
            default:
                echo "\nIngrese nuevamente una opcion: ";
                break;
        }
    }while($opc >3 || $opc<1);

}
function ingresarDatosJuego(){
    $datos=array();
    echo "\nCargar un Nuevo juego: \n";
    echo "\nIngrese Nombre de Juego:  ";
    $datos['nombrejuego']=trim(fgets(STDIN));

    do{
        echo "\nEl juego esta activo?: (ingrese 1 para verdadero, 0 para falso) ";
        $activo=trim(fgets(STDIN));
        
        if($activo!=0 && $activo!=1){
            echo "\nEl dato Ingresado es incorrecto \n";
        }
    }while($activo!=0 && $activo!=1);
    $datos['activo']=$activo;
    
    echo "\nIngrese edad permitida:  ";
    $datos['edad']=esNumero();
     
    echo "\nIngrese altura permitida(cm):  ";
    $datos['altura']= esNumero();
     
    echo "\nIngrese el maximo de personas permitidas:  ";
    $datos['max']= esNumero();

    echo "\nIngrese el parque al que pertenece:  ";
    $datos['unparque']= verificarParque();
    
    $datos['tipojuego']=tipoJuego();

    $abmJuego= new ABMJuego();
    $abmJuego->altaJuego($datos);
    
}

function modificarJuego(){
    $datos=array();
    echo "\nModificar Juego";
    $unJuego=verificarJuego();

    echo "\nIngresar el nuevo nombre del juego:  ";
    $datos['nombre']=trim(fgets(STDIN));

    echo "\nIngrese edad permitida:  ";
    $datos['edad']=esNumero();
     
    echo "\nIngrese altura permitida(cm):  ";
    $datos['altura']= esNumero();
     
    echo "\nIngrese el maximo de personas permitidas:  ";
    $datos['max']= esNumero();

    $abmJuego=new ABMJuego();
    $abmJuego->modificar($unJuego,$datos);
}

function buscarJuegoXcodigo(){
    $abmJuego=new ABMJuego();
    echo "\nBuscar Juego por Codigo\n";
    $tipoJuego=tipoJuego();
    echo "\nIngrese el codigo del Juego que desea buscar:  ";
    $codigo=trim(fgets(STDIN));
    $unJuego=$abmJuego->buscarXcodigo($tipoJuego,$codigo);
    if($unJuego==null){
        echo "\nNo se ha encontrado datos almacenados\n";
    }else{
        echo "\n".$unJuego."\n";
    }

}

function buscarJuegoXNombre(){
    $abmJuego=new ABMJuego();
    echo "\nBuscar juegos por nombre\n";
    $tipoJuego=tipoJuego();
    echo "\nIngrese el nombre del Juego que desea buscar:  ";
    $nombreJuego=trim(fgets(STDIN));

    $abmJuego->buscarXNombre($tipoJuego,$nombreJuego);

}

function buscarJuegosXactividad(){
    $abmJuego=new ABMJuego();
    echo "\nBuscar todos los juegos según si esta activo o no.\n";
    $tipoJuego=tipoJuego();
    do{
        echo "\nIngrese 1 para verdadero, 0 para falso: ";
        $activo=trim(fgets(STDIN));
        
        if($activo!=0 && $activo!=1){
            echo "\nEl dato Ingresado es incorrecto \n";
        }
    }while($activo!=0 && $activo!=1);

    $abmJuego->buscarXactivo($tipoJuego,$actvo);
}

function subMenuJuego(){
    echo "\n---------------<<Menu Juego>>--------------\n";
    echo "\n1. Mostrar listado de Juegos \n";
    echo "\n2. Cargar un nuevo Juego \n";
    echo "\n3. Modificar datos \n";
    echo "\n4. Buscar por codigo \n";
    echo "\n5. Buscar por nombre \n";
    echo "\n6. Buscar juegos activos o inactivos \n";
    echo "\n7. Eliminar un Juego \n";
    echo "\n8. salir \n";
    echo "\n---------------<<Menu Juego>>--------------\n";
    echo "\nIngrese una opcion: ";

    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 8){
        echo "\nIngrese nuevamente una opcion del 1 al 8:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;
}

function submenuJuegosOpcion(){
    $abmJuego=new ABMJuego();
    do{
        $opcionJuego=subMenuJuego();
        switch($opcionJuego){
            case 1:
                listarJuegos();
                break;
            case 2:
                //ingresarDatos
                IngresarDatosJuego();
                break;
            case 3:
                //modificarDatos
                modificarJuego();
                break;
            case 4:
                //buscarXcodigo
                buscarJuegoXcodigo();
                break;
            case 5:
                //buscarXnombre
                buscarJuegoXnombre();
                break;
            case 6:
                //buscarXactividad
                buscarJuegoXactividad();
                break;
            case 7:
                //eliminarJuego
                $unJuego=verificarJuego();
                $abmJuego->bajaJuego($unJuego);
                break;
        }
    }while($opcionJuego != 8);
    //vuelve al menu principal
    menuPrincipalOpcion();

}
/* <<<<<<<<<<<<<<<<<<<<--Juego-->>>>>>>>>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<<<<--Visitante-->>>>>>>>>>>>>>>>>>>>> */
function verificarVisitante(){
    $resp=false;
    $abmVisitante=new ABMVisitante();
    $abmVisitante->listarVisitante();
    do{
      $dni=verificarDni();
      $unVisitante=$abmVisitante->buscarXDni($dni);
      if($unVisitante==null){
        echo "\nEl dato no se encuentra almacenado ingrese nuevamete:  ";
        $resp=false;
      }else{
        $resp=true;
      }

    }while(!$resp);
    //
    //$unVisitante=$abmVisitante->buscarXDni($dni);
    echo "\n".$unVisitante."\n";
    return $unVisitante;
    //
}

/* Verifica si el formato del dni es correcto */
function verificarDni(){
    $resp=false;

    echo "\nIngrese el numero de Dni:  ";
    do{
      $nrodni=trim(fgets(STDIN));
      if(!is_numeric($nrodni) || strlen($nrodni)<7){
        echo "\nEl dato Ingresado es incorrecto, ingrese nuevamente:  ";
        $resp=false;
      }else{
        //echo "\nEl dato Ingresado es correcto\n";
        $resp= true;
      }
    }while($resp==false);

    return $nrodni;
}

/* Ingresa datos nuevos  */
function IngresarDatosVisitante(){
    $abmVisitante=new ABMVisitante();

    $datos=array();
    echo "\nIngrese Nombre del Visitante:  ";
    $datos['nombre']=trim(fgets(STDIN));
    echo "\nIngrese Apellido: ";
    $datos['apellido']=trim(fgets(STDIN));
    echo "\nIngrese Altura:  ";
    $datos['altura']=esNumero();
    echo "\nIngrese tipoDoc: ";
    $datos['tipodoc']=trim(fgets(STDIN));

    //echo "\nIngrese nrodoc:  ";
    $datos['nrodoc']=verificarDni();
    echo "\nIngrese fecha de Nacimiento: \n";
    $datos['fechaNac']=ingresarFecha();

    $abmVisitante->alta($datos);
}

function modificarVisitante(){
    $abmVisitante=new ABMVisitante();
    $unVisitante=verificarVisitante();
    echo "\nIngrese nuevo Nombre del visitante: ";
    $datos['nombre']=trim(fgets(STDIN));
    echo "\nIngrese nuevo Apellido del visitante: ";
    $datos['apellido']=trim(fgets(STDIN));

    $abmVisitante->modificarNombreApellido($unVisitante,$datos);
}

function subMenuVisitante(){
    echo "\n--------------<<Menu Visitante>>--------------\n";
    echo "\n1. Mostrar listado de Visitante \n";
    echo "\n2. Cargar un Nuevo Visitante \n";
    echo "\n3. Modificar datos \n";
    echo "\n4. Buscar por dni \n";
    echo "\n5. Buscar por Nombre \n";
    echo "\n6. Eliminar datos Visitante \n";
    echo "\n7. Salir \n";
    echo "\n--------------<<Menu visitante>>--------------\n";

    echo "\nIngrese una opcion:  ";
    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 7){
        echo "\nIngrese nuevamente una opcion del 1 al 7:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;
}

function submenuVisitanteOpcion(){
    $abmVisitante=new ABMVisitante();
    
    do{
        $opcionV=subMenuVisitante();
        switch($opcionV){
            case 1:
                $abmVisitante->listarVisitante();
                break;
            case 2:
                //echo "\ningresar datos\n";
                IngresarDatosVisitante();
                break;
            case 3:
                //modificarDatos
                modificarVisitante();
                break;
            case 4:
                //buscarXDni
                $dni=verificarDni();
                echo "\n".$abmVisitante->buscarXDni($dni)."\n";
                break;
            case 5:
                //buscarXNombre
                echo "\nIngrese nuevo Nombre del visitante: ";
                $nombre=trim(fgets(STDIN));
                $abmVisitante->buscarXNombre($nombre);
                break;
            case 6:
                //ELiminarVisitante
                $unVisitante=verificarVisitante();
                $abmVisitante->bajaVisitante($unVisitante);
                break;
        }
        
    }while($opcionV!=7);
    //vuelve al Menu Principal
    menuPrincipalOpcion();
}
/* <<<<<<<<<<<<<<<<<<<--Visitante-->>>>>>>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<<<<<<--Pase-->>>>>>>>>>>>>>>>>>>>>>> */

function verificarPase(){
    $resp=false;
    $abmPase=new ABMPase();
    $abmPase->listarPase();
    echo "\nIngrese el id del Pase: ";
    do{
      $id=esNumero();
      $unPase=$abmPase->buscarXID($id);
      if($unPase==null){
        echo "\nEl dato no se encuentra almacenado ingrese nuevamete\n";
        $resp=false;
      }else{
        $resp=true;
      }
    }while(!$resp);
    //
    //$unPase=$abmPase->buscarXID($id);
    echo "\n".$unPase."\n";
    return $unPase;
    //
}


/* Carga un nuevo pase a la bd */
function IngresarDatosPase(){
    echo "\nCargar un nuevo pase: \n";
    $datos['visitante']=verificarVisitante();

    echo "\nIngrese fecha de emision: \n";
    $datos['fechaemision']=ingresarFecha();

    echo "\nIngrese cantidad de juegos: ";
    $datos['cantidadjuegos']=trim(fgets(STDIN));

    do{
        echo "\nEs con aptitud?: (ingrese 1 para verdadero, 0 para falso) ";
        $datos['conaptitud']=trim(fgets(STDIN));
        
        if($datos['conaptitud']!=0 && $datos['conaptitud']!=1){
            echo "\nEl dato Ingresado es incorrecto \n";
        }
    }while($datos['conaptitud']!=0 && $datos['conaptitud']!=1);
    
    
    $datos['parque']= verificarParque();

    $abmPase=new ABMPase();
    $abmPase->alta($datos);
}
/* Modifica aptitud del pase*/
function modificarPase(){
    echo "\nModificar Aptitud: \n";
    $unPase=verificarPase();
    //echo "\n".$unPase."\n";
    
    if($unPase!=null){
        do{
            echo "\nModificar aptitud: (ingrese 1 para verdadero, 0 para falso) ";
            $dato=trim(fgets(STDIN));
            
            if($dato!=0 && $dato!=1){
                echo "\nEl dato Ingresado es incorrecto \n";
            }
        }while($dato!=0 && $dato!=1);
        $abmPase=new ABMPase();
        $abmPase->modificarAptitud($unPase,$dato);
    }

}

function buscarPaseXID(){
    $abmPase= new ABMPase();
    echo "\n ingrese id del pase: ";
    $id=esNumero();
    $unPase=$abmPase->buscarXID($id);
    if($unPase!=null){
       echo "\n".$unPase."\n";

    }else{
        echo "\nNo se encontro ningun dato almacenado\n";
    }
}

function buscarPaseXFecha(){
    $abmPase= new ABMPase();
    $fecha=ingresarFecha();
    $abmPase->buscarXFecha($fecha);
}

function buscarPaseXCantidad(){
    $abmPase= new ABMPase();
    echo "\nIngrese la cantidad de juegos: ";
    $num=esNumero();
    $abmPase->buscarXCantidad($num);
}


function subMenuPase(){
    echo "\n----------------<<Menu Pase>>-----------------\n";
    echo "\n1. Mostrar listado de Pase \n";
    echo "\n2. Cargar un Nuevo Pase \n";
    echo "\n3. Modificar datos \n";
    echo "\n4. Buscar por id \n";
    echo "\n5. Buscar por fecha emision \n";
    echo "\n6. Buscar por cantidad de juego \n";
    echo "\n7. Eliminar un Pase \n";
    echo "\n8. salir \n";

    echo "\n----------------<<Menu Pase>>-----------------\n";
    echo "\nIngrese una opcion:  ";
    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 8){
        echo "\nIngrese nuevamente una opcion del 1 al 8:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;
}

function submenuPasesOpcion(){
    $abmPase=new ABMPase();
    do{
        $opcionPase=subMenuPase();
        switch($opcionPase){
            case 1:
                $abmPase->listarPase();
                break;
            case 2:
                //ingresarDatos
                IngresarDatosPase();
                break;
            case 3:
                //modificarDatos
                modificarPase();
                break;
            case 4:
                //buscarXID
                buscarPaseXID();
                break;
            case 5:
                //buscarXFechaEmision
                buscarPaseXFecha();
                break;
            case 6:
                //buscarXCantidadDeJuego
                buscarPaseXCantidad();
                break;
            case 7:
                //eliminarPase
                $unPase=verificarPase();
                $abmPase->bajaPase($unPase);
                break;   
        }
    }while($opcionPase != 8);
    //vuelve al menu principal
    menuPrincipalOpcion();

}
/* <<<<<<<<<<<<<<<<<<<<<--Pase-->>>>>>>>>>>>>>>>>>>>>>> */



/* <<<<<<<<<<<<<<<<<<--Iniciar Juego-->>>>>>>>>>>>>>>>>> */

function jugar(){
    $abmJuego=new ABMJuego();

    echo "\nJugar un juego\n";
    echo "\nIngrese el Pase\n";
    $unPase=verificarPase();

    echo "\nIngrese el juego que desea subir\n";
    $unJuego=verificarJuego();

    $abmJuego->iniciarJuego($unPase,$unJuego);
}

/* function activarJuegos(){
    echo "\nActivar juego\n";
    echo "\nIngrese el juego que desea activar\n";
    

} */


function verJuegosMasJugados(){
    $abmJuego= new ABMJuego();
    echo "\nVer los juegos mas Jugados\n";
    echo "\nIngrese el numero de juegos que desea visualizar: ";
    $n=esNumero();

    $col=$abmJuego->juegosMasJugados($n);
    foreach($col as $tipoJuego=>$juego){
        echo "\n Tipo Juego: ".$tipoJuego;
        foreach($juego as $unElemento){
            echo "";
            echo "\n Juego:".$unElemento->getNombreJuego()."\n";
            echo "\n cantidad personas:".$unElemento->getTotalPersonas()."\n";
 
        }
    }
    
}

function verElJuegoMasJugado(){
    $abmJuego= new ABMJuego();
    echo "\nVer el juegos mas Jugado por tipo\n";
    $tipo=tipoJuego();
    $juego=$abmJuego->juegoMasJugadoXtipo($tipo);
    
    echo "";
    echo "\n".$juego."\n";
}

function subMenuIniciarJuego(){
    echo "\n----------------<<Menu Iniciar Juego>>-----------------\n";
    echo "\n1. Jugar Juego \n";
    echo "\n2. Activar Juego \n";
    echo "\n3. Juegos más Jugados \n";
    echo "\n4. Juegos más Jugados por tipo \n";
    
    echo "\n5. salir \n";

    echo "\n----------------<<Menu Iniciar Juego>>-----------------\n";
    echo "\nIngrese una opcion:  ";
    $opc = trim(fgets(STDIN));
    while ($opc<1 || $opc > 5){
        echo "\nIngrese nuevamente una opcion del 1 al 5:  ";
        $opc = trim(fgets(STDIN));
    }
    return $opc;
}

function submenuIniciarJuegoOpcion(){
    $abmJuego=new ABMJuego();
    do{
        $opcionIniJuego=subMenuIniciarJuego();
        switch($opcionIniJuego){
            case 1:
                jugar();
                break;
            case 2:
                
                break;
            case 3:
                verJuegosMasJugados();
                break;
            case 4:
                verElJuegoMasJugado();
                break;
            /* case 5:
                break;    */
        }
    }while($opcionIniJuego != 5);
    //vuelve al menu principal
    menuPrincipalOpcion();

}
/* <<<<<<<<<<<<<<<<<<--Iniciar Juego-->>>>>>>>>>>>>>>>>> */















/* <<<<<<<<<<<<<<<<<<<--Inicio-->>>>>>>>>>>>>>>>>>>>>>> */
echo "Parque, tpFinal";

menuPrincipalOpcion();

?>