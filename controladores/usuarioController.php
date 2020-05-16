
<?php

// llegando $controller, $data, $action
//$data = data_submitted();
$respuesta = false;

if($action=='alta'){
    if (isset($data['usnombre']) and isset($data['uspass'])){
        $objC = new AbmUsuario();
        $usuarioRepetido = $objC -> buscar($data);
        if(count($usuarioRepetido)<1) {
            $respuesta = $objC->alta($data);

            $param = array();
            $param = $objC->buscar($data);
            $param = $param[0];

            $datos = array();
            $datos['id'] = $param->getIdusuario();
            $datos['idrol'] = 2;

            $otroObjC = new AbmUsuariorol();
            $otraRespuesta = $otroObjC->alta($datos);
        }
        if (!$respuesta and !$otraRespuesta){
            $mensaje = " La accion  ALTA no pudo concretarse";
        }
    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;

    }
}elseif ($action=='baja'){
    if (isset($data['id'])){
        $objC = new AbmUsuario();
        $otroObjC = new AbmUsuariorol();

        $objetoRol = $otroObjC ->buscar($data);

        $param = array();
        foreach ($objetoRol as $rol){
            $param['id']=$data['id'];
            $param['idrol']=$rol -> getObjRol() -> getIdRol();

            $otraRespuesta = $otroObjC->baja($param);
        }

        $respuesta = $objC -> baja($data);
        if (!$respuesta and !$otraRespuesta){
            $mensaje = " La accion  ELIMINACION No pudo concretarse";
        }
    }
    $salida['respuesta']=$respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$mensaje;
    }

}elseif ($action=='editar'){
    if (isset($data['id'])){
        $objC = new AbmUsuario();
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
    $objControl = new AbmUsuario();
    $list = $objControl->buscar($data);
    $salida =  array();
    foreach ($list as $elem ){

        $nuevoElem['id'] = $elem->getIdusuario();
        $nuevoElem["usnombre"]=$elem->getUsnombre();
        $nuevoElem["uspass"]=$elem->getUspass();
        $nuevoElem["usmail"]=$elem->getUsmail();
        $nuevoElem["usdeshabilitado"]=$elem->getUsdeshabilitado();
        array_push($salida,$nuevoElem);
    }

}


?>
