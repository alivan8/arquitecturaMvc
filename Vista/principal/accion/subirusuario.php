<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$objC = new AbmUsuario();

if (isset($data['usnombre']) and isset($data['uspass'])) {
    $usuariorepetido = $objC -> buscar($data);
    if (count($usuariorepetido)<1){
        $respuesta = $objC->alta($data);

        $param=array();
        $param=$objC -> buscar($data);
        $param=$param[0];

        $datos=array();
        $datos['idusuario']=$param -> getIdusuario();
        $datos['idrol']=2;

        $otroObjC = new AbmUsuariorol();
        $otraRespuesta = $otroObjC->alta($datos);

    }
}
if($respuesta and $otraRespuesta){
    header("Location: ../login.php");
}else{
    header("Location: ../nuevousuario.php");
}