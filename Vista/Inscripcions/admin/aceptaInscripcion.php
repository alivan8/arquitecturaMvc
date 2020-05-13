<?php

include_once '../../../configuracion.php';
$idinscripcion=$_GET['idinscripcion'];
$admin=new Admin();
if($admin->aceptarinscripcion($idinscripcion)){
    header('Location: ../inscripcions.php');
}else{
    echo "hubo un error";
}