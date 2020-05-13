<?php
class Usuariorol {

    private $objUsuario;
    private $objRol;
    private $mensajeoperacion;

    public function __construct(){

        $this->objUsuario=NULL;
        $this->objRol=NULL;
        $this->mensajeoperacion="";

    }

    public function setear($objUsuario, $objRol){

        $this->objUsuario=$objUsuario;
        $this->objRol=$objRol;
    }



    public function getObjUsuario(){
        return $this->objUsuario;
    }

    public function getObjRol(){
        return $this->objRol;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }



    public function setObjUsuario($valor){
        $this->objUsuario = $valor;
    }

    public function setObjRol($valor){
        $this->objRol = $valor;
    }


    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idusuario= ". $this->getObjUsuario()->getIdusuario()." AND idrol= ". $this->getObjRol()->getIdrol();

        if ($base->Iniciar()) {

            $res = $base->Ejecutar($sql);

            if($res>-1){
                if($res>0){
                    $objRol = null;
                    $objUsuario = null;
                    $row = $base->Registro();

                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }

                    if ($row['idusuario']!=null){

                        $objUsuario = new Usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $this->setear($objUsuario, $objRol) ;
                }
            }
        } else {
            $this->setmensajeoperacion("usuariorol->listar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
        $resp = false;
        $base=new BaseDatos();

        $sql="INSERT INTO usuariorol(idusuario, idrol)VALUES(".$this->getObjUsuario()->getIdusuario().",".$this->getObjRol()->getIdrol().");";
        //echo $sql;
        if ($base->Iniciar()) {

            if ($base->Ejecutar($sql)) {
                $resp = true;

            } else {
                $this->setmensajeoperacion("usuariorol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql=" UPDATE usuariorol SET ";
        $sql.=" idrol = ".$this->getObjRol()->getIdRol();
        $sql.=" WHERE idusuario =".$this->getObjUsuario()->getIdusuario();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;

            } else {
                $this->setmensajeoperacion("Usuariorol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuariorol->modificar 2: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idusuario='". $this->getObjUsuario()->getIdusuario()."' AND idrol='".$this->getObjRol()->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("usuariorol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuariorol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){

        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){

                    $objUsuario =null;
                    $objRol =null;

                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }

                    if($row['idusuario']!=null){
                        $objUsuario = new Usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }

                    $obj= new Usuariorol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }











}

/*$usuario=new Usuario();
$usuario->setIdusuario(1);
//echo $usuario->getIdusuario();
$usuario->cargar();

$rol=new Rol();
$rol->setIdRol(2);
$rol->cargar();

$usuarioRol=new Usuariorol();
$usuarioRol->setear($usuario,$rol);
$usuarioRol->cargar();
verEstructura($usuarioRol);*/
