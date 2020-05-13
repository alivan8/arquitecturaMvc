<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 8/nov/2018
 * Time: 15:35
 */

class Cliente extends Carrito
{




    public function misinscripcions(){

        $usuarioLogueado=new Session();
        $objUsuario=$usuarioLogueado->getUsuario();

        $idUsuarioLogueado=$objUsuario->getIdusuario();
        $AbmInscripcion=new AbmInscripcion();
        $misinscripcions=$AbmInscripcion->buscar(['idusuario'=>$idUsuarioLogueado]);

        return $misinscripcions;



    }

    public function ultimoEstadoinscripcion($idinscripcion){
        $AbmInscripcionEstado=new AbmInscripcionestado();
        $arreglo=$AbmInscripcionEstado->buscar(['idinscripcion'=>$idinscripcion]);
        $total=count($arreglo);

        $indice=$total-1;
        $objetoUltimoEstado=$arreglo[$indice];
        $estado=$objetoUltimoEstado->getObjinscripcionestadotipo()->getdescripcion();

        return $estado;



    }

    public function cancelarinscripcion($idinscripcion){
        
        $estado=false;
        if($this->cambiarEstadoinscripcion($idinscripcion,4)){
            $estado=true;
        }

        return $estado;
    }

    public function devolverEntrada(){


        verEstructura($this->obtenerArregloIteminscripcion());

    }




}