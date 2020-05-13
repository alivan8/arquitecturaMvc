<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new AbmMenurol();
$list = $objControl->buscar($data);
$objC = new AbmMenu();
$listaMenu = $objC -> buscar(null);
$arreglo_salida =  array();
foreach ($list as $elem ){
    $nuevoElem['idmenu'] = $elem->getObjMenu()->getIdMenu();
    $nuevoElem["menombre"]=$elem->getObjMenu()->getMenombre();
    $nuevoElem["medescripcion"]=$elem->getObjMenu()->getMedescripcion();
    $nuevoElem["idrol"]=$elem->getObjRol()->getIdRol();
    $nuevoElem["rodescripcion"]=$elem->getObjRol()->getRoDescripcion();
    array_push($arreglo_salida,$nuevoElem);
}
echo json_encode($arreglo_salida,null,2);
?>
