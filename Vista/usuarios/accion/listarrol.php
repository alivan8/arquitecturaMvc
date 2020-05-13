<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new AbmRol();
$list = $objControl->buscar($data);
$arreglo_salida =  array();
foreach ($list as $elem ){

    $nuevoElem['idrol'] = $elem->getIdrol();
    $nuevoElem['rodescripcion']=$elem->getRodescripcion();

    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida,null,2);

?>