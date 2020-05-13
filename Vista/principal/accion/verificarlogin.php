<?php

include_once '../../../configuracion.php';
$datos=data_submitted();

$claseSession=new Session();

$usuario=null;

$usuario=$claseSession->iniciar($datos['usnombre'],$datos['uspass']);

if($claseSession->validar() and $claseSession->getUsuario()->getUsdeshabilitado() == null) {

    header("Location:../principal.php");

    } else {
    session_destroy();
    header("Location:../login.php");


}
