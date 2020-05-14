<?php
$respuesta = false;

if($action=='alta') {
    if (isset($data['id']) and isset($data['idrol'])){

        $objC = new AbmMenurol();

        $respuesta = $objC->alta($data);

        if (!$respuesta){

            $sms_error = " La accion ALTA no pudo concretarse";

        }
    }

    $salida['respuesta'] = $respuesta;

    if (isset($mensaje)){

        $salida['errorMsg']=$sms_error;


    }
}elseif ($action=='baja'){
    if (isset($data['id'])){
        $objC = new AbmMenurol();
        $respuesta = $objC->baja($data);
        if (!$respuesta){
            $sms_error = " La accion  ELIMINACION No pudo concretarse";
        }
    }
    $salida['respuesta'] = $respuesta;

    if (isset($mensaje)){

        $salida['errorMsg']=$sms_error;
    }
}elseif ($action=='editar'){
    if (isset($data['id'])){
        $objC = new AbmMenurol();
        $respuesta = $objC->modificacion($data);

        if (!$respuesta){

            $sms_error = " La accion  MODIFICACION No pudo concretarse";

        }else $respuesta =true;

    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$sms_error;

    }
}elseif ($action=='listar'){
    $objControl = new AbmMenurol();
    $list = $objControl->buscar($data);
    $objC = new AbmMenu();
    $listaMenu = $objC -> buscar(null);
    $salida =  array();
    foreach ($list as $elem ){
        $nuevoElem['id'] = $elem->getObjMenu()->getIdMenu();
        $nuevoElem["menombre"]=$elem->getObjMenu()->getMenombre();
        $nuevoElem["medescripcion"]=$elem->getObjMenu()->getMedescripcion();
        $nuevoElem["idrol"]=$elem->getObjRol()->getIdRol();
        $nuevoElem["rodescripcion"]=$elem->getObjRol()->getRoDescripcion();
        array_push($salida,$nuevoElem);
    }
}



?>