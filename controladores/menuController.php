<?php 


$respuesta = false;
if($action=='alta'){
    if (isset($data['menombre'])){
        $objC = new AbmMenu();
        $respuesta = $objC->alta($data);
        if (!$respuesta){
            $mensaje = " La accion  ALTA No pudo concretarse";
        }
    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;

    }
}elseif ($action=='baja'){
    if (isset($data['id'])){
        $objC = new AbmMenu();
        $respuesta = $objC->baja($data);
        if (!$respuesta){
            $mensaje = " La accion  ELIMINACION No pudo concretarse";
        }
    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;

    }
}elseif ($action=='editar'){
    $respuesta = false;
    if (isset($data['id'])){
        $objC = new AbmMenu();
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
    $objControl = new AbmMenu();
    $list = $objControl->buscar($data);
    $salida =  array();
    foreach ($list as $elem ){

        $nuevoElem['id'] = $elem->getIdMenu();
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

        array_push($salida,$nuevoElem);
    }
}



?>