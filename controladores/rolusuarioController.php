
<?php

$respuesta = false;

if($action=='alta'){
    if (isset($data['id'])) {
        $objC = new AbmUsuariorol();

        $respuesta = $objC -> alta($data);

        if (!$respuesta){

            $sms_error = " La accion  MODIFICACION No pudo concretarse";

        }

    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$sms_error;

    }
}elseif ($action=='baja'){
    if (isset($data['id'])){
        $objC = new AbmUsuariorol();
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
    if (isset($data['id'])) {
        $objC = new AbmUsuariorol();

        $respuesta = $objC->modificacion($data);

        if (!$respuesta){

            $sms_error = " La accion  MODIFICACION No pudo concretarse";

        }

    }
    $salida['respuesta'] = $respuesta;
    if (isset($mensaje)){

        $salida['errorMsg']=$sms_error;

    }
}elseif ($action=='listar'){
    $objControl = new AbmUsuariorol();
    $list = $objControl->buscar($data);

    $objControlUsuario = new AbmUsuario();
    $listaUsuario = $objControlUsuario->buscar(null);

    function tieneRol($usu,$usurol){
        $tieneRol = false;
        foreach ($usurol as $elem)
            if($usu->getIdusuario() == $elem -> getObjUsuario() -> getIdusuario()){
                $tieneRol = true;
            }

        return $tieneRol;
    }

    $salida =  array();



    foreach ($list as $elem){
        $nuevoElem['id'] = $elem->getObjUsuario()->getIdusuario();
        $nuevoElem['usnombre']=$elem->getObjUsuario()->getUsnombre();
        $nuevoElem['idrol']=$elem->getObjRol()->getIdrol();
        $nuevoElem["rodescripcion"]=$elem->getObjRol()->getRodescripcion();

        array_push($salida,$nuevoElem);

    }


    foreach ($listaUsuario as $objUsuario) {
        if (!tieneRol($objUsuario, $list)) {
            $nuevoElem['id'] = $objUsuario->getIdusuario();
            $nuevoElem['usnombre'] = $objUsuario->getUsnombre();
            $nuevoElem['idrol'] = '';
            $nuevoElem["rodescripcion"] = '';

            array_push($salida,$nuevoElem);


        }


    }
}


?>


