<?php 
class inscripcionestadotipo{
    
    private $idinscripcionestadotipo;
    private $descripcion;
    private $detalle;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idinscripcionestadotipo="";
        $this -> descripcion="";
        $this -> detalle="";
        $this -> mensajeoperacion="";
    }
    
    //Metodo de acceso GET
    
    public function getidinscripcionestadotipo()
    {
        return $this->idinscripcionestadotipo;
    }

    public function getdescripcion()
    {
        return $this->descripcion;
    }

    public function getdetalle()
    {
        return $this->detalle;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    //Metodo de acceso SET
    
    public function setidinscripcionestadotipo($idinscripcionestadotipo)
    {
        $this->idinscripcionestadotipo = $idinscripcionestadotipo;
    }

    public function setdescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setdetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idinscripcionestadotipo, $descripcion, $detalle){
        $this -> idinscripcionestadotipo=$idinscripcionestadotipo;
        $this -> descripcion=$descripcion;
        $this -> detalle=$detalle;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionestadotipo WHERE idinscripcionestadotipo = ".$this->getidinscripcionestadotipo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idinscripcionestadotipo'], $row['descripcion'], $row['detalle']);
                }
            }
        } else {
            $this->setmensajeoperacion("inscripcionestadotipo->cargar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO inscripcionestadotipo(descripcion, detalle) VALUES('".$this -> getdescripcion()."','".$this -> getdetalle()."');";

        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setidinscripcionestadotipo($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionestadotipo->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("inscripcionestadotipo->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE inscripcionestadotipo SET descripcion='".$this->getdescripcion()."' detalle='".$this -> getdetalle()."' WHERE idinscripcionestadotipo =".$this->getidinscripcionestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;                
            } else {
                $this->setmensajeoperacion("inscripcionestadotipo->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionestadotipo->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM inscripcionestadotipo WHERE idinscripcionestadotipo =".$this -> getidinscripcionestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionestadotipo->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionestadotipo->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionestadotipo ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new inscripcionestadotipo();
                    $obj->setear($row['idinscripcionestadotipo'], $row['descripcion'], $row['detalle']);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }
}
?>