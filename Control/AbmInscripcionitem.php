<?php 
class AbmInscripcionitem{
  
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object inscripcionitem
     */
    
    private function cargarObjeto($param){

        $objinscripcionitem = null;
        $objevento = null;
        $objinscripcion = null;
        
        if( array_key_exists('idinscripcionitem',$param) and $param['idinscripcionitem']!=null ){
            $objinscripcionitem = new inscripcionitem();
            $objinscripcionitem->setidinscripcionitem($param['idinscripcionitem']);
            $objinscripcionitem->cargar();
            
        }
        
        if( array_key_exists('idinscripcion',$param) and $param['idinscripcion']!=null ){
            $objinscripcion = new inscripcion();
            $objinscripcion->setidinscripcion($param['idinscripcion']);
            $objinscripcion->cargar();

            
        }
        
        if( array_key_exists('id',$param) and $param['id']!='null' ){
            $objevento = new evento();
            $objevento->setid($param['id']);
            $objevento->cargar();

        }
                
        if( array_key_exists('cicantidad',$param) and array_key_exists('importe',$param) and $param['cicantidad']!=null and $param['importe']!=null){

            if ($objinscripcionitem==null){


                $objinscripcionitem = new inscripcionitem();
                $objinscripcionitem->setear("", $objevento,$objinscripcion,$param['cicantidad'],$param['importe']);

            }
                        
        }        
        return $objinscripcionitem;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object inscripcionitem
     */
    private function cargarObjetoConClave($param){
        $objinscripcionitem = null;
        
        if( isset($param['idinscripcionitem']) ){
            $objinscripcionitem = new inscripcionitem();
            $objinscripcionitem->setear($param['idinscripcionitem'], null, null, "","");
        }
        return $objinscripcionitem;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idinscripcionitem']))
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
        $param['idinscripcionitem'] =null;
        $elObjtinscripcionitem = $this->cargarObjeto($param);


        if ($elObjtinscripcionitem!=null and $elObjtinscripcionitem->insertar()){

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
            $elObjtinscripcionitem = $this->cargarObjetoConClave($param);
            if ($elObjtinscripcionitem!=null and $elObjtinscripcionitem->eliminar()){
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
            $elObjtinscripcionitem = $this->cargarObjeto($param);
            if($elObjtinscripcionitem!=null and $elObjtinscripcionitem->modificar()){
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
            if  (isset($param['idinscripcionitem']))
                $where.=" and idinscripcionitem =".$param['idinscripcionitem'];
            if  (isset($param['id']))
                $where.=" and id =".$param['id'];
            if  (isset($param['idinscripcion']))
                $where.=" and idinscripcion =".$param['idinscripcion'];
            if  (isset($param['cicantidad']))
                $where.=" and cicantidad =".$param['cicantidad'];
            if  (isset($param['importe']))
                $where.=" and importe =".$param['importe'];
        }
        $arreglo = inscripcionitem::listar($where);
        return $arreglo;
    }
}
?>