<?php
function call($controller,$action,$data){
    $salida =null;
    switch ($controller){
        case 'pages':
            require_once ("principal1.php");
            break;
        case 'AbmEvento':
            require_once "../../controladores/eventoController.php";
            break;
        case 'AbmMenu':
            require_once "../../controladores/menuController.php";
            break;
        case 'AbmMenurol':
            require_once "../../controladores/menurolController.php";
            break;

    }
    return $salida;
}






$controllers = array(
    'pages'=>['principal1'],
    'AbmEvento'=>['alta','baja','editar','listar'],
    'AbmMenu'=>['alta','baja','editar','listar'],
    'AbmMenurol'=>['alta','baja','editar','listar']
);

if (array_key_exists($controller,$controllers)){
    if(in_array($action,$controllers[$controller])){
            $salida = call($controller, $action, $data);
    }else{
        /////
        echo "error";
    }
}else{
    ////
    echo "error";
}


?>

