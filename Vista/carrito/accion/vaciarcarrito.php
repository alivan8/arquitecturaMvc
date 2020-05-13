<?php

include_once '../../../configuracion.php';
$carrito=new Carrito();
$carrito->vaciar();
header('Location: ../carrito.php');
?>