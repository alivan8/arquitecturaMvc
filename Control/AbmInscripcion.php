<?php 
class AbmInscripcion{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object inscripcionitem
     */
    
    public function cargarObjeto($param){

        
        $objinscripcion=null;
        $objUsuario=null;
        
        if( array_key_exists('idinscripcion',$param) ){


            $objinscripcion = new inscripcion();
            $objinscripcion->setidinscripcion($param['idinscripcion']);
            if($objinscripcion->cargar()==false){

                $objinscripcion=null;
            }


        }
        
        if( array_key_exists('idusuario',$param) and $param['idusuario']!=null ){
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']);
            $objUsuario->cargar();


        }

        if( array_key_exists('cofecha',$param) and $param['cofecha']!=null){


            if ($objinscripcion==null){

                $objinscripcion=new inscripcion();



                $objinscripcion->setear($param['idinscripcion'], $param['cofecha'],$objUsuario);
            }
            
        }
        return $objinscripcion;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object inscripcionitem
     */
    private function cargarObjetoConClave($param){
        
        $objinscripcion = null;
        
        if( isset($param['idinscripcion']) and isset($param['idusuario'])){
            $objinscripcion = new inscripcion();
            $objinscripcion->setear($param['idinscripcionitem'], "",null);
        }
        return $objinscripcion;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idinscripcion']))
            $resp = true;
            return $resp;
    }
    
    /**
     * Permite cargar objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idinscripcion'] =null;
        $elObjtinscripcion = $this->cargarObjeto($param);
        //print_r($elObjtinscripcion);
        if ($elObjtinscripcion!=null and $elObjtinscripcion->insertar()){
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
            $elObjtinscripcion = $this->cargarObjetoConClave($param);
            if ($elObjtinscripcion!=null and $elObjtinscripcion->eliminar()){
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
            $elObjtinscripcion = $this->cargarObjeto($param);
            if($elObjtinscripcion!=null and $elObjtinscripcion->modificar()){
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
        //verEstructura($param);
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idinscripcion']))
                $where.=" and idinscripcion =".$param['idinscripcion'];
            if  (isset($param['cofecha']))
                $where.=" and cofecha =".$param['cofecha'];
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
           }
        $arreglo = inscripcion::listar($where);
        return $arreglo;
    }
}
?>