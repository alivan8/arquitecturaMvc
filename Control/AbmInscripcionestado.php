<?php 
class AbmInscripcionestado{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object inscripcionestado
     */
    
    public function cargarObjeto($param){
        
        $objinscripcionestado = null;
        $objinscripcion = null;
        $objinscripcionestadotipo = null;
        
        if( array_key_exists('idinscripcionestado',$param) and $param['idinscripcionestado']!=null ){

            $objinscripcionestado = new inscripcionestado();
            $objinscripcionestado->setidinscripcionestado($param['idinscripcionestado']);
            $objinscripcionestado->cargar();
            
        }
        
        if( array_key_exists('idinscripcion',$param) and $param['idinscripcion']!=null ){

            $objinscripcion = new inscripcion();
            $objinscripcion->setidinscripcion($param['idinscripcion']);
            $objinscripcion->cargar();

            
        }
        
        if( array_key_exists('idinscripcionestadotipo',$param) and $param['idinscripcionestadotipo']!='null' ){
            $objinscripcionestadotipo = new inscripcionestadotipo();
            $objinscripcionestadotipo->setidinscripcionestadotipo($param['idinscripcionestadotipo']);
            $objinscripcionestadotipo->cargar();

        }
        
        if( array_key_exists('fechaini',$param) and array_key_exists('fechafin',$param) and $param['fechaini']!=null and $param['fechafin']==null){

            if ($objinscripcionestado==null){
                $objinscripcionestado = new inscripcionestado();
                $objinscripcionestado->setear("", $objinscripcion,$objinscripcionestadotipo,$param['fechaini'],$param['fechafin']);
                $objinscripcionestado->setfechafin(null);


                /*verEstructura($objinscripcionestado);
                die();*/
            }            
        }
        return $objinscripcionestado;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object inscripcionestado
     */
    private function cargarObjetoConClave($param){
        $objinscripcionestado = null;
        
        if( isset($param['idinscripcionestado']) ){
            $objinscripcionestado = new inscripcionestado();
            $objinscripcionestado->setear($param['idcomprestado'], null, null, "","");
        }
        return $objinscripcionestado;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idinscripcionestado']))
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
        $param['idinscripcionestado'] =null;
        $elObjtinscripcionestado = $this->cargarObjeto($param);
        if ($elObjtinscripcionestado!=null and $elObjtinscripcionestado->insertar()){
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
            $elObjtinscripcionestado = $this->cargarObjetoConClave($param);
            if ($elObjtinscripcionestado!=null and $elObjtinscripcionestado->eliminar()){
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
            $elObjtinscripcionestado = $this->cargarObjeto($param);
            if($elObjtinscripcionestado!=null and $elObjtinscripcionestado->modificar()){
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
       // verEstructura($param);
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idinscripcionestado']))
                $where.=" and idinscripcionestado =".$param['idinscripcionestado'];
            if  (isset($param['idinscripcion']))
                $where.=" and idinscripcion =".$param['idinscripcion'];
            if  (isset($param['idinscripcionestadotipo']))
                $where.=" and idinscripcionestadotipo =".$param['idinscripcionestadotipo'];
            if  (isset($param['fechaini']))
                $where.=" and fechaini =".$param['fechaini'];
            if  (isset($param['fechafin']))
                $where.=" and fechafin =".$param['fechafin'];
        }
        $arreglo = inscripcionestado::listar($where);
        return $arreglo;
    }
}
?>