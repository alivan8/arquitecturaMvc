<?php
class Rol{

    private $idrol;
    private $rodescripcion;
    private $mensajeoperacion;


    public function __construct()
    {
        $this->idrol='';
        $this->rodescripcion='';

    }

    public function getIdRol(){
        return $this->idrol;
    }

    public function setIdRol($valor){
        $this->idrol=$valor;
    }

    public function getRoDescripcion(){
        return $this->rodescripcion;
    }

    public function setRoDescripcion($valor){
        $this->rodescripcion=$valor;
    }

    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeOperacion($valor){
        $this->mensajeoperacion=$valor;
    }

    public function setear($idrol,$roldescripcion){
        $this->idrol=$idrol;
        $this->rodescripcion=$roldescripcion;
    }
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol WHERE idrol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                }
            }
        } else {
            $this->setMensajeOperacion("evento->cargar: ".$base->getError()[2]);
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(rodescripcion)  VALUES('".$this -> getRoDescripcion()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdRol($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("Rol->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE rol SET rodescripcion='".$this->getRoDescripcion()."'  WHERE idrol =".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;

            } else {
                $this->setmensajeoperacion("Rol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->modificar 2: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol =".$this -> getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idrol'], $row['rodescripcion']);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }




}


