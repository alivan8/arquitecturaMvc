
<?php

// llegando $controller, $data, $action
//$data = data_submitted();
$respuesta = false;

if($action=='alta'){
    if (isset($data['rodescripcion'])){

        $objC = new AbmRol();
        $respuesta = $objC->alta($data);

        if (!$respuesta){
            $mensaje = " La accion  ALTA no pudo concretarse";
        }
    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;

    }
}elseif ($action=='baja'){
    if (isset($data['id'])){
        $objC = new AbmRol();
        $respuesta = $objC->baja($data);

        if (!$respuesta){
            $mensaje = " La accion  ELIMINACION No pudo concretarse";
        }
    }
    $salida['respuesta']=$respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;
    }

}elseif ($action=='editar'){
    if (isset($data['id'])){
        $objC = new AbmRol();
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
    $objControl = new AbmRol();
    $list = $objControl->buscar($data);
    $salida =  array();
    foreach ($list as $elem ){

        $nuevoElem['id'] = $elem->getIdrol();
        $nuevoElem['rodescripcion']=$elem->getRodescripcion();

        array_push($salida,$nuevoElem);
    }
}


?>

