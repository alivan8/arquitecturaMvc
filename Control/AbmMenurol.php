<?php
class AbmMenurol{
    private function cargarObjeto($param){
        $objRol = null;
        $objtMenuRol = null;



        if( array_key_exists('idrol',$param) and $param['idrol']!=null ){
            $objRol = new Rol();
            $objRol->setIdRol($param['idrol']);
            $objRol->cargar();
        }

        if( array_key_exists('id',$param) && $param['id']!=null){
            $objMenu = new Menu();
            $objMenu->setIdmenu($param['id']);
            $objMenu->cargar();
        }

        $objtMenuRol = new Menurol();
        $objtMenuRol->setear($objRol,$objMenu);


        return $objtMenuRol;
    }

    private function cargarObjetoConClave($param){

        $objMenuRol = null;
        if( isset($param['id']) && isset($param['idrol']) ){
            $objMenuRol = new Menurol();
            $objMenuRol->setear($objMenu, $objRol);
        }
        return $objMenuRol;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['id']) && isset($param['idrol'])){
            $resp = true;
        }


        return $resp;

    }

    public function alta($param){

        $resp = false;
        $objMenuRol = $this->cargarObjeto($param);

        if ($objMenuRol!=null and $objMenuRol->insertar()){
            $resp = true;
        }

        return $resp;
    }

    public function baja($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)){

            $objMenuRol = $this->cargarObjeto($param);

            if ($objMenuRol !=null and $objMenuRol->eliminar()){

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){

        $resp = false;
        if ($this->seteadosCamposClaves($param)){

            $objMenuRol = $this->cargarObjeto($param);
            if($objMenuRol !=null and $objMenuRol->modificar()){
                $resp = true;

            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
                $where.=" and id='".$param['id']."'";
            if  (isset($param['idrol']))
                $where.=" and idrol ='".$param['idrol']."'";
        }

        $arreglo = Menurol::listar($where, "");
        return $arreglo;

    }
}
