<?php 
class inscripcionitem{
    
    private $idinscripcionitem;
    private $objevento;
    private $objinscripcion;
    private $cicantidad;
    private $importe;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idinscripcionitem="";
        $this -> objevento=NULL;
        $this -> objinscripcion=NULL;
        $this -> cicantidad="";
        $this -> importe="";
        $this -> mensajeoperacion="";
    }
    
    // Metodos de acceso GET
    
    public function getidinscripcionitem()
    {
        return $this->idinscripcionitem;
    }

    public function getObjevento()
    {
        return $this->objevento;
    }

    public function getObjinscripcion()
    {
        return $this->objinscripcion;
    }

    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodos de acceso SET
    
    
    public function setidinscripcionitem($idinscripcionitem)
    {
        $this->idinscripcionitem = $idinscripcionitem;
    }

    public function setObjevento($objevento)
    {
        $this->objevento = $objevento;
    }

    public function setObjinscripcion($objinscripcion)
    {
        $this->objinscripcion = $objinscripcion;
    }

    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idinscripcionitem, $objevento, $objinscripcion, $cicantidad, $importe){
        $this -> idinscripcionitem=$idinscripcionitem;
        $this -> objevento=$objevento;
        $this -> objinscripcion=$objinscripcion;
        $this -> cicantidad=$cicantidad;
        $this -> importe=$importe;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionitem WHERE idinscripcionitem = ".$this->getidinscripcionitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objevento =NULL;
                    $objinscripcion=NULL;
                    $row = $base->Registro();
                    if($row['id']!=null){
                        $objevento = new evento();
                        $objevento->setid($row['id']);
                        $objevento->cargar();
                    }
                    if($row['idinscripcion']!=null){
                        $objinscripcion = new inscripcion();
                        $objinscripcion->setidinscripcion($row['idinscripcion']);
                        $objinscripcion->cargar();
                    }
                    $this->setear($row['idinscripcionitem'], $objevento, $objinscripcion, $row['cicantidad'], $row['importe']);
                }
            }
        } else {
            $this->setmensajeoperacion("inscripcionitem->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO inscripcionitem(id, idinscripcion, cicantidad, importe)VALUES(".$this->getObjevento()->getid().",".$this->getObjinscripcion()->getidinscripcion().",".$this -> getCicantidad().",".$this -> getImporte().");";

        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setidinscripcionitem($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionitem->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("inscripcionitem->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE inscripcionitem SET id=".$this->getObjevento()->getid().",idinscripcion=".$this->getObjinscripcion()->getidinscripcion().", cicantidad=".$this -> getCicantidad().", importe=".$this -> getImporte()." WHERE idinscripcionitem=".$this->getidinscripcionitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionitem->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionitem->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM inscripcionitem WHERE idinscripcionitem =".$this->getidinscripcionitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionitem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionitem->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $objevento=NULL;
                    $objinscripcion=NULL;
                    if($row['id']!=null){
                        $objevento = new evento();
                        $objevento->setid($row['id']);
                        $objevento->cargar();
                    }
                    if($row['idinscripcion']!=null){
                        $objinscripcion = new inscripcion();
                        $objinscripcion->setidinscripcion($row['idinscripcion']);
                        $objinscripcion->cargar();
                    }
                    $obj= new inscripcionitem();
                    $obj->setear($row['idinscripcionitem'], $objevento, $objinscripcion, $row['cicantidad'], $row['importe']);
                    array_push($arreglo, $obj);
                }
            }
        }else{
            // $this->setmensajeoperacion("inscripcion->listar: ".$base->getError());
        }
        return $arreglo;
    }
    
}?>