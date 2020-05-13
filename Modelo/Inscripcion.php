<?php 
class inscripcion{
    
    private $idinscripcion;
    private $cofecha;
    private $objUsuario;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idinscripcion="";
        $this -> cofecha=NULL;
        $this -> objUsuario=NULL;
        $this -> mensajeoperacion="";
    }
    
    // Metodos de acceso GET
    
    public function getidinscripcion()
    {
        return $this->idinscripcion;
    }

    public function getCofecha()
    {
        return $this->cofecha;
    }

    public function getObjUsuario()
    {
        return $this->objUsuario;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodo de acceso SET
    
    public function setidinscripcion($idinscripcion)
    {
        $this->idinscripcion = $idinscripcion;
    }

    public function setCofecha($cofecha)
    {
        $this->cofecha = $cofecha;
    }

    public function setObjUsuario($objUsuario)
    {
        $this->objUsuario = $objUsuario;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idinscripcion, $cofecha, $objUsuario){
        $this->idinscripcion=$idinscripcion;
        $this->cofecha=$cofecha;
        $this->objUsuario=$objUsuario;
        
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcion WHERE idinscripcion = ".$this->getidinscripcion();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objUsuario = null;
                    $row = $base->Registro();
                    if($row['idusuario']!=null){
                        $objUsuario = new Usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $this->setear($row['idinscripcion'], $row['cofecha'], $objUsuario);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("inscripcion->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){      
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO inscripcion(cofecha, idusuario) VALUES ('".$this->getCofecha()."',".$this->getObjUsuario()->getIdusuario().");";


        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setidinscripcion($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcion->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("inscripcion->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE inscripcion SET cofecha=".$this->getCofecha().",idusuario=".$this->getObjUsuario()->getIdusuario()." WHERE idinscripcion=".$this->getidinscripcion();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcion->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcion->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM inscripcion WHERE idinscripcion =".$this->getidinscripcion();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("inscripcion->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("inscripcion->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM inscripcion ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }

        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $objUsuario =null;
                    if($row['idusuario']!=null){
                        $objUsuario = new Usuario();
                        $objUsuario->setIdusuario($row['idusuario']);
                        $objUsuario->cargar();
                    }
                    $obj= new inscripcion();
                    $obj->setear($row['idinscripcion'], $row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        }else{
            // $this->setmensajeoperacion("inscripcion->listar: ".$base->getError());
        }        
        return $arreglo;
    }
    
}
?>