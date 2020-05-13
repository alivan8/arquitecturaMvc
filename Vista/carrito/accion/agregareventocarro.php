<?php
include_once '../../../configuracion.php';
$data=data_submitted();
$carrito=new Carrito();
$carrito->agregarevento($data);
?>
