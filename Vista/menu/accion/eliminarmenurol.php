<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idmenu'])){
    $objC = new AbmMenurol();
    $respuesta = $objC->baja($data);
    if (!$respuesta){
        $sms_error = " La accion  ELIMINACION No pudo concretarse";
    }
}
$salida['respuesta'] = $respuesta;

if (isset($mensaje)){

    $salida['errorMsg']=$sms_error;
}
echo json_encode($salida);

?>