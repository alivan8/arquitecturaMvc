<?php 
class inscripcionestadotipo{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object inscripcionestadotipo
     */
    private function cargarObjeto($param){
        $objinscripcionestadotipo = null;
        
        if( array_key_exists('idinscripcionestadotipo',$param) and array_key_exists('descripcion',$param) and array_key_exists('detalle',$param)){
            $objinscripcionestadotipo = new inscripcionestadotipo();
            $objinscripcionestadotipo->setear($param['idinscripcionestadotipo'], $param['descripcion'],"", $param['detalle']);
        }
        return $objinscripcionestadotipo;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object inscripcionestadotipo
     */
    private function cargarObjetoConClave($param){
        $objinscripcionestadotipo = null;
        
        if( isset($param['idinscripcionestadotipo']) ){
            $objinscripcionestadotipo = new inscripcionestadotipo();
            $objinscripcionestadotipo->setear($param['idinscripcionestadotipo'], "", "");
        }
        return $objinscripcionestadotipo;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idinscripcionestadotipo']))
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
        $param['idinscripcionestadotipo'] =null;
        $elObjtinscripcionestadotipo = $this->cargarObjeto($param);
        if ($elObjtinscripcionestadotipo!=null and $elObjtinscripcionestadotipo->insertar()){
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
            $elObjtinscripcionestadotipo = $this->cargarObjetoConClave($param);
            if ($elObjtinscripcionestadotipo!=null and $elObjtinscripcionestadotipo->eliminar()){
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
            $elObjtinscripcionestadotipo = $this->cargarObjeto($param);
            if($elObjtinscripcionestadotipo!=null and $elObjtinscripcionestadotipo->modificar()){
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
            if  (isset($param['idinscripcionestadotipo']))
                $where.=" and idinscripcionestadotipo =".$param['idinscripcionestadotipo'];
            if  (isset($param['descripcion']))
                $where.=" and descripcion ='".$param['descripcion']."'";
            if  (isset($param['detalle']))
                $where.=" and detalle ='".$param['detalle']."'";
        }
        $arreglo = inscripcionestadotipo::listar($where);
        return $arreglo;
    }
}
?>