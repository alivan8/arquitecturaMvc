<?php
include_once "../../../configuracion.php";
$data = data_submitted();
if (isset($data['rodescripcion'])){

    $objC = new AbmRol();
    $respuesta = $objC->alta($data);

    if (!$respuesta){
        $mensaje = " La accion  ALTA no pudo concretarse";
    }
}
$salida['respuesta'] = $respuesta;
if (isset($mensaje)){

    $salida['errorMsg']=$mensaje;

}
echo json_encode($salida);

?>
