<?php

include_once "../../../configuracion.php";

$datos = data_submitted();

$objAbmUsuario = new AbmUsuario();

$resp = false;
if($objAbmUsuario->baja($datos)){

    $resp = true;

}

?>
