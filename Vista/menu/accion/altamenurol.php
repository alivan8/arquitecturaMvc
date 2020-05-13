<?php
include_once "../../../configuracion.php";
$data = data_submitted();

$respuesta = false;

if (isset($data['idmenu']) and isset($data['idrol'])){

    $objC = new AbmMenurol();

    $respuesta = $objC->alta($data);

    if (!$respuesta){

        $sms_error = " La accion ALTA no pudo concretarse";

    }
}

$salida['respuesta'] = $respuesta;

if (isset($mensaje)){

    $salida['errorMsg']=$sms_error;


}
echo json_encode($salida);
?>