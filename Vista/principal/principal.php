<?php
include_once "../../configuracion.php";
$salida= null;
$id =0;
$bandera= false;
if(!isset($_GET['controller']) && !isset($_GET['action'])){
    $controller = 'pages';
    $action = 'principal1';
    $data = null;
}else{
    $data = data_submitted();
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    if($action =='editar' or $action =='baja'){
        $id = $_GET['id'];
    }
    if ($_GET['action']=='listar'){
        $bandera= true;
    }
}

require_once("routes.php");
if ($bandera == 'true'){
      echo json_encode($salida,null,2);
}else{
    echo json_encode($salida);
}

?>
