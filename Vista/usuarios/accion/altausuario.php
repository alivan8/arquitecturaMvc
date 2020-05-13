<?php 
include_once "../../../configuracion.php";
$data = data_submitted();

if (isset($data['usnombre']) and isset($data['uspass'])){
    $objC = new AbmUsuario();
    $usuarioRepetido = $objC -> buscar($data);
    if(count($usuarioRepetido)<1) {
        $respuesta = $objC->alta($data);

        $param = array();
        $param = $objC->buscar($data);
        $param = $param[0];

        $datos = array();
        $datos['idusuario'] = $param->getIdusuario();
        $datos['idrol'] = 2;

        $otroObjC = new AbmUsuariorol();
        $otraRespuesta = $otroObjC->alta($datos);
    }
    if (!$respuesta and !$otraRespuesta){
        $mensaje = " La accion  ALTA no pudo concretarse";
    }
}
$salida['respuesta'] = $respuesta;
if (isset($mensaje)){
    
    $salida['errorMsg']=$mensaje;

}
echo json_encode($salida);

?>
