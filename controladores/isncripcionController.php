<?php

$respuesta = false;
if($action=='listar') {
    $admin = new Admin();
    $salida['inscripcions'] = $admin->inscripcionsPendientes();
    $salida['admin']=$admin;
    $salida['is_require']=true;
    $salida['require']='../Inscripcions/inscripcions.php';
}elseif ($action=='alta'){
    if ($id != null) {
        $admin = new Admin();
        if ($admin->aceptarinscripcion($id)) {
            header('Location: ../Inscripcions/inscripcions.php');
        } else {
            echo "hubo un erro no se puedo aceptar la inscripcionr";
        }
    } else {
        echo "hubo un orror no existe id";
    }

}elseif ($action=='baja'){
    if($id!=null){
        $admin=new Admin();
        if($admin->cancelarinscripcion($idinscripcion)){
            header('Location: ../Inscripcions/inscripcions.php');
        }else{
            echo "hubo un error, no se pudo cancelar";
        }
    }else{
        echo "no se recibio ningun id";
    }
}
?>
