<?php
include_once "../../../configuracion.php";
$data = data_submitted();

if (isset($data['idrol'])){
    $objC = new AbmRol();
    $respuesta = $objC->baja($data);

    if (!$respuesta){
        $mensaje = " La accion  ELIMINACION No pudo concretarse";
    }
}
$salida['respuesta']=$respuesta;
if (isset($mensaje)){

    $salida['errorMsg']=$mensaje;
}
echo json_encode($salida);

?>