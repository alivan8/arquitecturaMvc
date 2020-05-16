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
        case 'AbmRol':
            require_once "../../controladores/rolController.php";
            break;
        case 'AbmUsuario':
            require_once "../../controladores/usuarioController.php";

            break;
        case 'AbmUsuariorol':
            require_once "../../controladores/rolusuarioController.php";
            break;

    }
    return $salida;
}
$controllers = array(
    'pages'=>['principal1'],
    'AbmEvento'=>['alta','baja','editar','listar'],
    'AbmMenu'=>['alta','baja','editar','listar'],
    'AbmMenurol'=>['alta','baja','editar','listar'],
    'AbmRol'=>['alta','baja','editar','listar'],
    'AbmUsuario'=>['alta','baja','editar','listar'],
    'AbmUsuariorol'=>['alta','baja','editar','listar']
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

