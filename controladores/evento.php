<?php 

// llegando $controller, $data, $action
//$data = data_submitted();
$respuesta = false;

if($action=='alta'){
    if (isset($data['nombre'])){
        $objC = new AbmEvento();
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
        $objC = new AbmEvento();
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
    if (isset($data['id'])){
        $objC = new AbmEvento();
        $respuesta = $objC->modificacion($data);

        if (!$respuesta){

            $mensaje = " La accion  MODIFICACION No pudo concretarse";

        }

    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;

    }
}elseif ($action=='listar'){
    $objControl = new AbmEvento();
    $list = $objControl->buscar($data);
    $salida =  array();
    foreach ($list as $elem ){

        $nuevoElem['id'] = $elem->getid();
        $nuevoElem["nombre"]=$elem->getnombre();
        $nuevoElem["detalle"]=$elem->getdetalle();
        $nuevoElem["cantentrada"]=$elem->getcantentrada();
        $nuevoElem["importe"]=$elem->getimporte();
        $nuevoElem["imagen"]=$elem->getimagen();
        array_push($salida,$nuevoElem);
    }



}






?>


