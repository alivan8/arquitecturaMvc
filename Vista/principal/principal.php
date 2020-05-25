<?php
include_once "../../configuracion.php";
$salida = null;
$id = 0;
$bandera = false;
if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller = 'pages';
    $action = 'principal1';
    $data = null;
} else {
    $data = data_submitted();
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    if($controller=='AbmInscripcion'){
        $id = $_GET['id'];
    }
    if ($_GET['action'] == 'listar') {
        $bandera = true;
    }
}

require_once("routes.php");
if (isset($salida['is_require'])) {
    $inscripcions=   $salida['inscripcions'];
     $admin=$salida['admin'];
    require_once($salida['require']);
} elseif ($bandera == 'true') {
    echo json_encode($salida, null, 2);
} else {
    echo json_encode($salida);
}
?>
