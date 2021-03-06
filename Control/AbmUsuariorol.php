<?php

class AbmUsuariorol{
    private function cargarObjeto($param){

        $objUsuarioRol = null;
        $objRol = null;
        $objUsuario = null;

        if( array_key_exists('idrol',$param) and $param['idrol']!=null ){
            $objRol = new Rol();
            $objRol->setIdRol($param['idrol']);
            $objRol->cargar();
        }

        if( array_key_exists('id',$param) && $param['id']!=null){
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['id']);
            $objUsuario->cargar();
        }

        $objUsuarioRol = new Usuariorol();
        $objUsuarioRol->setear($objUsuario, $objRol);

        return $objUsuarioRol;
    }

    private function cargarObjetoConClave($param){
        $objUsuarioRol = null;
        if( isset($param['id']) && isset($param['idrol']) ){
            $objUsuarioRol = new UsuarioRol();
            $objUsuarioRol->setear($objUsuario, $objRol);
        }
        return $objUsuarioRol;
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
        $objUsuarioRol = $this->cargarObjeto($param);

        if ($objUsuarioRol!=null and $objUsuarioRol->insertar()){
            $resp = true;
        }

        return $resp;
    }

    public function baja($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)){

            $objUsuarioRol = $this->cargarObjeto($param);

            if ($objUsuarioRol !=null and $objUsuarioRol->eliminar()){

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){

        $resp = false;
        if ($this->seteadosCamposClaves($param)){

            $objUsuarioRol = $this->cargarObjeto($param);

            if($objUsuarioRol !=null and $objUsuarioRol->modificar()){
                $resp = true;

            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
                $where.=" and id=".$param['id'];
            if  (isset($param['idrol']))
                $where.=" and idrol =".$param['idrol'];
        }

        $arreglo = Usuariorol::listar($where, "");
        return $arreglo;

    }


}