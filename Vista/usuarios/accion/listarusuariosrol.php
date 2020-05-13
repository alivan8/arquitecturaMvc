<?php
include_once "../../../configuracion.php";
$data = data_submitted();
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

$arreglo_salida =  array();



foreach ($list as $elem){
        $nuevoElem['idusuario'] = $elem->getObjUsuario()->getIdusuario();
        $nuevoElem['usnombre']=$elem->getObjUsuario()->getUsnombre();
        $nuevoElem['idrol']=$elem->getObjRol()->getIdrol();
        $nuevoElem["rodescripcion"]=$elem->getObjRol()->getRodescripcion();

    array_push($arreglo_salida,$nuevoElem);

}


foreach ($listaUsuario as $objUsuario) {
    if (!tieneRol($objUsuario, $list)) {
        $nuevoElem['idusuario'] = $objUsuario->getIdusuario();
        $nuevoElem['usnombre'] = $objUsuario->getUsnombre();
        $nuevoElem['idrol'] = '';
        $nuevoElem["rodescripcion"] = '';

        array_push($arreglo_salida,$nuevoElem);


    }


}

echo json_encode($arreglo_salida,null,2);

?>