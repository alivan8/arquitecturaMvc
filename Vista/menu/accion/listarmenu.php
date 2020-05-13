<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new AbmMenu();
$list = $objControl->buscar($data);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idmenu'] = $elem->getIdMenu();
    $nuevoElem["menombre"]=$elem->getMenombre();
    $nuevoElem["medescripcion"]=$elem->getMedescripcion();
    if($elem->getObjMenu()!=null){
        $nuevoElem["idpadre"]=$elem->getObjMenu()->getIdMenu();
        $nuevoElem["menombrepadre"]=$elem->getObjMenu()->getMenombre();
    }else{
        $nuevoElem["idpadre"]=null;
        $nuevoElem["menombrepadre"]=null;
    }
    $nuevoElem["medeshabilitado"]=$elem->getMedeshabilitado();
   
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida,null,2);

?>