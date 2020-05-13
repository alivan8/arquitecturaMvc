<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta=false;
if (isset($data['idusuario'])){
    $objC = new AbmUsuariorol();
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