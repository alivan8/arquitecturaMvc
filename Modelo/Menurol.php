<?php

class Menurol{
      private $objmenu;
      private $objrol;
      private $mensajeoperacion;


      public function __construct()
      {
          $this->objmenu=null;
          $this->objrol=null;
      }

      public function getObjMenu(){
          return $this->objmenu;
      }

      public function setObjMenu($valor){
          $this->objmenu=$valor;


      }

      public function getObjRol(){
          return $this->objrol;
      }

      public function setObjRol($valor){
          $this->objrol=$valor;
      }
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * @param string $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

      public function setear($objRol,$objMenu){
          $this->objrol=$objRol;
          $this->objmenu=$objMenu;
      }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getObjMenu()->getIdmenu()." AND  idrol=".$this->getObjRol()->getIdRol()  ;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objMenu = null;
                    $objRol = null;
                    $row = $base->Registro();
                    if($row['idmenu']!=null){
                        $objMenu = new Menu();
                        $objMenu->setIdmenu($row['idmenu']);
                        $objMenu->cargar();
                    }
                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }
                    $this->setear($objMenu,$objRol) ;

                }
            }
        } else {
            $this->setMensajeoperacion("Menurol->cargar: ".$base->getError());
        }
        return $resp;


    }

    public function insertar(){

        $resp = false;
        $base=new BaseDatos();
        //verEstructura($this);
        $sql="INSERT INTO menurol(idmenu, idrol) VALUES (".$this->getObjMenu()->getIdmenu().",".$this->getObjRol()->getIdRol().");";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Menurol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menurol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql=" UPDATE menurol SET ";
        $sql.=" idrol = ".$this->getObjRol()->getIdRol();
        $sql.=" WHERE idmenu =".$this->getObjMenu()->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;

            } else {
                $this->setmensajeoperacion("MenuRol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->modificar 2: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menurol WHERE idmenu='". $this->getObjMenu()->getIdmenu()."' AND idrol='".$this->getObjRol()->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("menurol->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){

        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol ";

        //echo $sql;
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;

        }
        //  echo $sql;

        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){

                    $objMenu =null;
                    $objRol =null;

                    if($row['idrol']!=null){
                        $objRol = new Rol();
                        $objRol->setIdRol($row['idrol']);
                        $objRol->cargar();
                    }

                    if($row['idmenu']!=null){
                        $objMenu = new Menu();
                        $objMenu->setIdmenu($row['idmenu']);
                        $objMenu->cargar();
                    }

                    $obj= new Menurol();
                    $obj->setear($objRol, $objMenu);
                    array_push($arreglo, $obj);
                }
            }
        } else {

        }
        return $arreglo;
    }



}

//menu
/*$menu=new Menu();
$menu->setIdmenu(7);
$menu->cargar();

//rol
$rol=new Rol();
$rol->setIdRol(2);
$rol->cargar();




$menuRol=new Menurol();
$menuRol->setear($rol,$menu);
//verEstructura($menuRol);
//$menuRol->insertar();
$menuRol->eliminar();*/
