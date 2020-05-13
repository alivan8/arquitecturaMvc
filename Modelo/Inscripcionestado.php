<?php 
class inscripcionestado{

    private $idinscripcionestado;
    private $objinscripcion;
    private $objinscripcionestadotipo;
    private $fechaini;
    private $fechafin;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idinscripcionestado="";
        $this -> objinscripcion=NULL;
        $this -> objinscripcionestadotipo=NULL;
        $this -> fechaini="";
        $this -> fechafin=null;
        $this -> mensajeoperacion="";
    }
    
    // Metodo de acceso GET
    
    public function getidinscripcionestado()
    {
        return $this->idinscripcionestado;
    }

    public function getObjinscripcion()
    {
        return $this->objinscripcion;
    }

    public function getObjinscripcionestadotipo()
    {
        return $this->objinscripcionestadotipo;
    }

    public function getfechaini()
    {
        return $this->fechaini;
    }

    public function getfechafin()
    {
        return $this->fechafin;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodos de acceso SET
    
    public function setidinscripcionestado($idinscripcionestado)
    {
        $this->idinscripcionestado = $idinscripcionestado;
    }

    public function setObjinscripcion($objinscripcion)
    {
        $this->objinscripcion = $objinscripcion;
    }

    public function setObjinscripcionestadotipo($objinscripcionestadotipo)
    {
        $this->objinscripcionestadotipo = $objinscripcionestadotipo;
    }

    public function setfechaini($fechaini)
    {
        $this->fechaini = $fechaini;
    }

    public function setfechafin($fechafin)
    {
        $this->fechafin = $fechafin;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompaestado, $objinscripcion, $objinscripcionestadotipo, $fechaini, $fechafin){
        $this -> idinscripcionestado=$idcompaestado;
        $this -> objinscripcion=$objinscripcion;
        $this -> objinscripcionestadotipo=$objinscripcionestadotipo;
        $this -> fechaini=$fechaini;
        $this -> fechafin=$fechafin;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionestado WHERE idinscripcionestado = ".$this->getidinscripcionestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objinscripcion=NULL;
                    $objinscripcionestadotipo=NULL;
                    $row = $base->Registro();
                    if($row['idinscripcion']!=null){
                        $objinscripcion = new inscripcion();
                        $objinscripcion->setidinscripcion($row['idinscripcion']);
                        $objinscripcion->cargar();
                    }
                    if($row['idinscripcionestadotipo']!=null){
                        $objinscripcionestadotipo = new inscripcionestadotipo();
                        $objinscripcionestadotipo->setidinscripcionestadotipo($row['idinscripcionestadotipo']);
                        $objinscripcionestadotipo->cargar();
                    }
                    $this->setear($row['idinscripcionestado'], $objinscripcion, $objinscripcionestadotipo, $row['fechaini'], $row['fechafin']);
                }
            }
        } else {
            $this->setmensajeoperacion("inscripcionestado->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();

        $sql="INSERT INTO inscripcionestado(idinscripcion, idinscripcionestadotipo, fechaini, fechafin)VALUES(".$this->getObjinscripcion()->getidinscripcion().",".$this->getObjinscripcionestadotipo()->getidinscripcionestadotipo().",'".$this -> getfechaini()."','".$this -> getfechafin()."');";





        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setidinscripcionestado($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionestado->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("inscripcionestado->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE inscripcionestado SET idinscripcion=".$this->getObjinscripcion()->getidinscripcion().",idinscripcionestadotipo=".$this->getObjinscripcionestadotipo()->getidinscripcionestadotipo().", fechaini='".$this -> getfechaini()."', fechafin='".$this -> getfechafin()."' WHERE idinscripcionestado=".$this->getidinscripcionestado().';';

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionestado->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionestado->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM inscripcionestado WHERE idinscripcionestado =".$this->getidinscripcionestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcionestado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcionestado->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcionestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;


        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){                    
                    $objinscripcion=NULL;
                    $objinscripcionestadotipo=NULL;
                    if($row['idinscripcion']!=null){
                        $objinscripcion = new inscripcion();
                        $objinscripcion->setidinscripcion($row['idinscripcion']);
                        $objinscripcion->cargar();
                    }
                    if($row['idinscripcionestadotipo']!=null){
                        $objinscripcionestadotipo = new inscripcionestadotipo();
                        $objinscripcionestadotipo->setidinscripcionestadotipo($row['idinscripcionestadotipo']);
                        $objinscripcionestadotipo->cargar();
                    }
                    $obj= new inscripcionestado();
                    $obj->setear($row['idinscripcionestado'], $objinscripcion, $objinscripcionestadotipo, $row['fechaini'], $row['fechafin']);
                    array_push($arreglo, $obj);
                }
            }
        }else{
            // $this->setmensajeoperacion("inscripcion->listar: ".$base->getError());
        }
        return $arreglo;
    }
}?>