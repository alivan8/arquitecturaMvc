<?php
function call1($controller,$action,$data){
$salida =null;
    switch ($controller){
        case 'pages':
            require_once ("principal1.php");
            break;
        case 'AbmEvento':
            require_once "../../controladores/evento.php";
            break;

    }
    return $salida;
}

function call2($controller, $action,$data,$id){
    $salida =null;
    switch ($controller){
        case 'pages':
            require_once ("principal1.php");
            break;
        case 'AbmEvento':
            require_once "../../controladores/evento.php";
            break;

    }
    return $salida;
}




$controllers = array(
    'pages'=>['principal1'],
    'AbmEvento'=>['alta','baja','editar','listar']
);

if (array_key_exists($controller,$controllers)){
    if(in_array($action,$controllers[$controller])){
        if ($controller=='pages'){
            $salida = call1($controller, $action, $data);
        }elseif ($action =='editar' or $action =='baja'){
            $salida = call2($controller,$action,$data,$id);
        }elseif ($action =='alta' or $action =='listar'){
            $salida = call1($controller, $action, $data);
        }

    }else{
        /////
         echo "error";
    }
}else{
    ////
    echo "error";
}


?>

