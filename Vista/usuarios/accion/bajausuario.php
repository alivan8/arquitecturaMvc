<?php
include_once "../../../configuracion.php";
$data = data_submitted();

if (isset($data['idusuario'])){
    $objC = new AbmUsuario();
    $otroObjC = new AbmUsuariorol();

    $objetoRol = $otroObjC ->buscar($data);

    $param = array();
    foreach ($objetoRol as $rol){
        $param['idusuario']=$data['idusuario'];
        $param['idrol']=$rol -> getObjRol() -> getIdRol();

        $otraRespuesta = $otroObjC->baja($param);
    }

    $respuesta = $objC -> baja($data);
    if (!$respuesta and !$otraRespuesta){
        $mensaje = " La accion  ELIMINACION No pudo concretarse";
    }
}
$salida['respuesta']=$respuesta;
if (isset($mensaje)){
   
    $salida['errorMsg']=$mensaje;
}
echo json_encode($salida);

?>