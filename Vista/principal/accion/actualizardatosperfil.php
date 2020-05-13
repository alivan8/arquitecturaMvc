<?php
include_once '../../../configuracion.php';
$datos=data_submitted();
$claseSession=new Session();
$usuario=null;

$objC = new AbmUsuario();
$respuesta = $objC->modificacion($datos);

if($respuesta){
    session_destroy();
    header("Location: ../login.php");
}else{
    echo "<h1> No se pudo actualizar </h1>";
}

?>

