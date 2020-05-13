<?php




include_once '../../../configuracion.php';
$idinscripcion=$_GET['idinscripcion'];


$cliente=new Cliente();
if($cliente->cancelarinscripcion($idinscripcion)){
    header('Location: ../misinscripcions.php');
}else{
    echo "hubo un error";
}




?>