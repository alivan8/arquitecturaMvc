<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 22/oct/2018
 * Time: 19:19
 */

class AbmRol{

    private function cargarObjeto($param){
        $obj = null;

        if( array_key_exists('id',$param) and array_key_exists('rodescripcion',$param)){
            $obj = new Rol();
            $obj->setear($param['id'], $param['rodescripcion']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if( isset($param['id']) ){
            $obj = new Rol();
            $obj->setear($param['id'], null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['id']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $param['id'] =null;
        $elObjtRol = $this->cargarObjeto($param);
        //        verEstructura($elObjtTabla);
        if ($elObjtRol!=null and $elObjtRol->insertar()){
            $resp = true;
        }
        return $resp;

    }

    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtRol = $this->cargarObjetoConClave($param);
            if ($elObjtRol!=null and $elObjtRol->eliminar()){
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param){

        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtRol = $this->cargarObjeto($param);
            if($elObjtRol!=null and $elObjtRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
                $where.=" and id =".$param['id'];
            if  (isset($param['rodescripcion']))
                $where.=" and rodescripcion ='".$param['rodescripcion']."'";
        }
        $arreglo = Rol::listar($where);
        return $arreglo;




    }

}