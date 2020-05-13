<?php
//session_start();

function data_submitted() {
    
    $_AAux= array();
    if (!empty($_REQUEST))
        $_AAux =$_REQUEST;
     if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
     return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}
spl_autoload_register(function ($class_name) {
    $PROYECTO ='Arquitectura/proyecto-MVC';
    $ROOT=$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";
    //echo "class ".$class_name ;
    $directorys = array(
        $ROOT.'Modelo/',
        $ROOT.'Modelo/conector/',
        $ROOT.'Control/',
      //  $GLOBALS['ROOT'].'util/class/',
    );
    //print_object($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$class_name . '.php')){
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$class_name . '.php');
            return;
        }
    }
});

function subirArchivo($archivo,$nombre){
    $dir = '/xampp/htdocs/Arquitectura/proyecto-MVC/Imagenes'; // Definimos Directorio donde se guarda el archivo
    $_FILES['miArchivo']['name'] = $nombre;
    $resp = false;
    // Comprobamos que no se hayan producido errores
    $tiposArchivos = ["image/jpeg", "image/jpg"];
    if (in_array($_FILES['miArchivo']['type'],$tiposArchivos)) {
        if ($_FILES['miArchivo']['size'] < 2097152) {
            if ($_FILES['miArchivo']['error'] <= 0) {
                // Intentamos copiar el archivo al servidor.
                if (!copy($_FILES['miArchivo']['tmp_name'], $dir . $_FILES['miArchivo']['name'])) {
                    $resp =false;
                } else {
                    $resp = true;
                }
            } else {
                $resp =false;
            }
        } else {
            $resp =false;
        }
    } else {
        $resp =false;
    }
    return $resp;
}

?>