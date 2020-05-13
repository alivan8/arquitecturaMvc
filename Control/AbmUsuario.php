<?php 
class AbmUsuario{
    
     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Usuario
     */
    private function cargarObjeto($param){
        
        $objUsuario = null;

        if( array_key_exists('idusuario',$param) and array_key_exists('usnombre',$param) and array_key_exists('uspass',$param) and array_key_exists('usmail',$param)){
            $objUsuario = new Usuario();

            $param['uspass'] = md5($param['uspass']);

            if(isset($param['usdeshabilitado']) and $param['usdeshabilitado'] == 1) {
                $param['usdeshabilitado'] = date("Y-m-d H:i:s");
            }else{
                $param['usdeshabilitado'] = null;
            }
            $objUsuario->setear($param['idusuario'], $param['usnombre'],$param['uspass'], $param['usmail'], $param['usdeshabilitado']);
        }
        return $objUsuario;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object evento
     */
    private function cargarObjetoConClave($param){
        
        $objUsuario = null;
        
        if( isset($param['idusuario']) ){
            $objUsuario = new Usuario();
            $objUsuario->setear($param['idusuario'], "", "", "", "");
        }
        return $objUsuario;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idusuario']))
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
        $param['idusuario'] =null;
        $elObjtUsuario = $this->cargarObjeto($param);
        if ($elObjtUsuario!=null and $elObjtUsuario->insertar()){
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
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario!=null and $elObjtUsuario->eliminar()){
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
            $elObjtUsuario = $this->cargarObjeto($param);
            if($elObjtUsuario!=null and $elObjtUsuario->modificar()){
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['usnombre']))
                $where.=" and usnombre ='".$param['usnombre']."'";
            if  (isset($param['uspass']))
                $where.=" and uspass ='".md5($param['uspass'])."'";
            if  (isset($param['usmail']))
                $where.=" and usmail ='".$param['usmail']."'";
            //if  (isset($param['usdeshabilitado']))
            //    $where.=" and usdeshabilitado =".$param['usdeshabilitado'];
        }

        $arreglo = Usuario::listar($where);
        return $arreglo;
    }
}
?>