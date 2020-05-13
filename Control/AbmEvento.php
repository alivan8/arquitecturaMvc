<?php 
class AbmEvento{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object evento
     */
        private function cargarObjeto($param){
            $objevento = null;

            if( array_key_exists('id',$param) and array_key_exists('nombre',$param) and array_key_exists('cantentrada',$param) and array_key_exists('importe',$param)){
                $objevento = new evento();

                $objevento->setear($param['id'], $param['nombre'], $param['detalle'], $param['cantentrada'],$param['importe'],$param['imagen']);
            }
            return $objevento;
        }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object evento
     */
    public function cargarObjetoConClave($param){
        $objevento = null;
        
        if( isset($param['id']) ){
            $objevento = new evento();
            //$objevento->setear($param['id'], "", "", "", "");
            $objevento->setid($param['id']);
           // $objevento->cargar();
        }
        return $objevento;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['id']))
            $resp = true;
            return $resp;
    }
    
    /**
     * Permite crear un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['id']=null;
        $elObjtevento = $this->cargarObjeto($param);
        if ($elObjtevento!=null and $elObjtevento->insertar()){
            if ($_FILES['miArchivo'] != null){
                $listaProd = array();
                $listaProd = $this -> buscar($param);
                $cant = count($listaProd);
                $prod = $listaProd[$cant - 1];
                $param['id'] = $prod -> getid();
                $nombreProd = $prod -> getid().".jpg";
                $pudeSubirArchivo = subirArchivo($param,$nombreProd);

                if($pudeSubirArchivo) {
                    $param['imagen'] = "/Arquitectura/proyecto-MVC/Imagenes/" . $nombreProd;
                    $prod = $this -> modificacion($param);

                }
            }
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtevento = $this->cargarObjetoConClave($param);
            if ($elObjtevento!=null and $elObjtevento->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtevento = $this->cargarObjeto($param);
            if($elObjtevento!=null and $elObjtevento->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['id']))
                $where.=" and id =".$param['id'];
            if  (isset($param['nombre']))
                $where.=" and nombre ='".$param['nombre']."'";
            if  (isset($param['detalle']))
                $where.=" and detalle ='".$param['detalle']."'";
            if  (isset($param['cantentrada']))
                $where.=" and cantentrada =".$param['cantentrada'];
            if  (isset($param['importe']))
                $where.=" and importe =".$param['importe'];
            if  (isset($param['imagen']))
                $where.=" and imagen ='".$param['imagen']."'";
        }
        $arreglo = evento::listar($where);
        return $arreglo;      
    }
    
}
?>