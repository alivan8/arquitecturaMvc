<?php


class Carrito{


    public function verificainscripcion(){
        $estado=false;
        $inscripcion=new AbmInscripcion();

        $idUsuarioLogueado=$this->buscaUsuario();
        $inscripcionsdelUsuario=$inscripcion->buscar(['idusuario'=>$idUsuarioLogueado]);


        if(count($inscripcionsdelUsuario)>=1){
            //obtener la ultima inscripcion
            $totalinscripcions=count($inscripcionsdelUsuario);

            $indice=$totalinscripcions-1;



            $idinscripcion=$inscripcionsdelUsuario[$indice]->getidinscripcion();


            $inscripcionEstado=new AbmInscripcionestado();
            $objetoinscripcionEstado=$inscripcionEstado->buscar(['idinscripcion'=>$idinscripcion]);

            $totalEstados=count($objetoinscripcionEstado);

            $indice=$totalEstados-1;

            $estadoinscripcion=$objetoinscripcionEstado[$indice]->getObjinscripcionestadotipo()->getidinscripcionestadotipo();




            //la inscripcion esta ene stado iniciado y esta pendiente
            if($estadoinscripcion==1){
                $estado=true;
            }
        }



        return $estado;

    }

    private function buscaUsuario(){
        $sesion=new Session();
        $validar=$sesion->validar();
        if($validar==false){
            header('Location: ../Vista/principal/login.php');


        }
        $objUsuario=$sesion->getUsuario();

        $idUsuarioLogueado=$objUsuario->getIdusuario();

        return $idUsuarioLogueado;

    }
    private function buscaUltimainscripcionUsuario(){
        $objinscripcion=null;

        $idUsuarioLogueado=$this->buscaUsuario();

        $inscripcion=new AbmInscripcion();
        $inscripcionsdelUsuario=$inscripcion->buscar(['idusuario'=>$idUsuarioLogueado]);
        $totalinscripcions=count($inscripcionsdelUsuario);

        if(count($inscripcionsdelUsuario)>=1){

            //obtener la ultima inscripcion
            $totalinscripcions=count($inscripcionsdelUsuario);

            $indice=$totalinscripcions-1;
            $objinscripcion=$inscripcionsdelUsuario[$indice];

            $estado=$this->buscaEstadoinscripcion($objinscripcion);

            if($estado==true){
                return $objinscripcion;


            }
            else{
                $objinscripcion=null;
            }



        }


        return $objinscripcion;


    }

    public function objetoUltimainscripcionUsuario(){

        $objinscripcion=null;

        $idUsuarioLogueado=$this->buscaUsuario();

        $inscripcion=new AbmInscripcion();
        $inscripcionsdelUsuario=$inscripcion->buscar(['idusuario'=>$idUsuarioLogueado]);
        $totalinscripcions=count($inscripcionsdelUsuario);

        if(count($inscripcionsdelUsuario)>=1){

            //obtener la ultima inscripcion
            $totalinscripcions=count($inscripcionsdelUsuario);

            $indice=$totalinscripcions-1;
            $objinscripcion=$inscripcionsdelUsuario[$indice];
            
        



        }


        return $objinscripcion;

    }
    public function buscaEstadoinscripcion($objinscripcion){
        $estado=false;

        $idinscripcion=$objinscripcion->getidinscripcion();

        $inscripcionEstado=new AbmInscripcionestado();
        $param=['idinscripcion'=>$idinscripcion];
        $arregloEstado=$inscripcionEstado->buscar($param);

        $total=count($arregloEstado);
        $indice=$total-1;

        $objEstadoinscripcion=$arregloEstado[$indice];
        $estadoOBjinscripcion=$objEstadoinscripcion->getObjinscripcionestadotipo()->getidinscripcionestadotipo();

        if($estadoOBjinscripcion==1){
            $estado=true;
        }else{
            $estado=false;
        }



        return $estado;



    }
    //se crea la inscripcion en estado 1 (inicializado)
    public function crearinscripcion(){
        $sesion=new Session();
        $objUsuario=$sesion->getUsuario();
        $idUsuarioLogueado=$this->buscaUsuario();


        $inscripcion=new AbmInscripcion();

        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');
        $param=['idinscripcion'=>null,'cofecha'=>$hora,'idusuario'=>$idUsuarioLogueado];

        $objetoinscripcion=$inscripcion->cargarObjeto($param);

        if($objetoinscripcion->insertar()){

            //si se genera la inscripcion, tambien se genera el el nuevo estado de la inscripcion que seria 1
            $this->nuevoEstado(1,null);
        }

    }

    public function agregarevento($param){
        $param['importe']=$param['precio']*$param['cantidad'];


        $evento=new AbmEvento();
        $objevento=$evento->cargarObjetoConClave($param);
        $arregloevento=$evento->buscar($param);
        $evento=$arregloevento[0];



        if($this->verificainscripcion()){

            //verEstructura($evento);
            //echo '<hr>';
            //print_r($param);


            $objetoUltimainscripcion=$this->buscaUltimainscripcionUsuario();
            $idUltimainscripcion=$objetoUltimainscripcion->getidinscripcion();
            //print_r($idUltimainscripcion);

            $datos=['idinscripcion'=>$idUltimainscripcion,'id'=>$param['id'],'cicantidad'=>$param['cantidad'],'importe'=>$param['importe']];
            $cantidadPedida= $datos['cicantidad'];
            
            
            $this->actualizarEntrada($evento,$cantidadPedida,'restar');
            $objAbmInscripcionitem=new AbmInscripcionitem();
            if($objAbmInscripcionitem->alta($datos)){
                header('Location: ../../principal/principal.php');
            }else{
                echo 'error';
            }


        }else{
            $this->crearinscripcion();
            $this->agregarevento($param);
        }

    }
    public function obtenerArregloIteminscripcion(){
        $coleccioninscripcion=null;


        $inscripcion=$this->buscaUltimainscripcionUsuario();
        if($inscripcion!=null){
            $idinscripcion=$inscripcion->getidinscripcion();
            // echo $idinscripcion;
            $param=['idinscripcion'=>$idinscripcion];

            $AbmInscripcionitem=new AbmInscripcionitem();


            $coleccioninscripcion=$AbmInscripcionitem->buscar($param);
            // verEstructura($arregloinscripcionitem);

            return $coleccioninscripcion;
        }



    }


    private function nuevoEstado($nuevoEstado,$idinscripcion){
        $estado=false;
        if($idinscripcion==null){
            $objinscripcion=$this->objetoUltimainscripcionUsuario();
            $idinscripcion=$objinscripcion->getidinscripcion();
        }


        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');
        //se setea inscripcionestado con id 3
        $param=['idinscripcionestado'=>null,'idinscripcion'=>$idinscripcion,'idinscripcionestadotipo'=>$nuevoEstado,'fechaini'=>$hora,'fechafin'=>null];
        $inscripcionEstado=new AbmInscripcionestado();

        if($inscripcionEstado->alta($param)){
            $estado=true;
        }

        return $estado;

    }




    public function cambiarHoraEstadoAnterior($idinscripcion){
        $modificado=false;
        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');

        //$ultimainscripcionUsuario=$this->buscaUltimainscripcionUsuario();
        //$idUltimainscripcion=$ultimainscripcionUsuario->getidinscripcion();

        $AbmInscripcionEstado=new AbmInscripcionestado();
        $arregloEstadosinscripcion=$AbmInscripcionEstado->buscar(['idinscripcion'=>$idinscripcion]);
        $totalEstadosinscripcion=count($arregloEstadosinscripcion);
        $indice=$totalEstadosinscripcion-1;


        $arregloEstadosinscripcion[$indice]->setfechafin($hora);


        if($arregloEstadosinscripcion[$indice]->modificar()){

            $modificado=true;
        }
        return $modificado;
    }





    protected function  cambiarEstadoinscripcion($idinscripcion,$nuevoEstado){


        $cambiado=false;
        if($this->cambiarHoraEstadoAnterior($idinscripcion)){

            if($this->nuevoEstado($nuevoEstado,$idinscripcion)){
                $cambiado=true;

            }
        }

        return $cambiado;
    }


    public function terminarinscripcion(){
        $ultimainscripcionUsuario=$this->buscaUltimainscripcionUsuario();
        $idUltimainscripcion=$ultimainscripcionUsuario->getidinscripcion();
        $estado=false;

        if($this->cambiarEstadoinscripcion($idUltimainscripcion,3)){
            $estado=true;
        }

        return $estado;



    }



    public function quitarevento($param){
        $idinscripcionitem=$param['idinscripcionitem'];

        $itemsinscripcion=$this->obtenerArregloIteminscripcion();
        $inscripcion=$itemsinscripcion[0]->getObjinscripcion();

        $idinscripcion=$inscripcion->getidinscripcion();


        foreach ($itemsinscripcion as $item){
            
            
            if( $item->getidinscripcionitem()==$idinscripcionitem){
                //como vamos a quitar el item, devemos devolver la cantidad pedida al entrada del prod
                // se suma la cantidad pedida al entrada
                $this->actualizarEntrada($item->getObjevento(),$item->getCiCantidad(),'sumar');
                
                
                $AbmInscripcionitem=new AbmInscripcionitem();
                if($AbmInscripcionitem->baja($param)){
                    $totalItemsCarrito=count($this->obtenerArregloIteminscripcion());
                    //
                    if($totalItemsCarrito==0){
                      $this->cambiarEstadoinscripcion($idinscripcion,4);

                    }
                    header('Location: ../carrito.php');

                }


            }
        }



    }

 
    public function totalinscripcion(){
        $total=0;
        $arregloITems=$this->obtenerArregloIteminscripcion();
        if($arregloITems!=null){
            foreach ($arregloITems as $inscripcion){
                $total+=$inscripcion->getImporte();
            }
        }


        return $total;

    }

    
    //si el operador es restar(cuando se agrega un evento al carrito) , se resta lo pedido al entrada
    //si el operador es sumar(cuando se quita un evento del carrito) , se suma lo pedido al entrada

    public function actualizarEntrada($objevento,$cantidadPedida,$operador){
        $actualizado=false;
        $cantidadActualevento=$objevento->getcantentrada();

        
        
        if($operador=='restar'){
           $nuevoEntrada=$cantidadActualevento-$cantidadPedida;
        }else{
            $nuevoEntrada=$cantidadActualevento+$cantidadPedida;
        }
        $AbmEvento=new AbmEvento();
            $param['id'] = $objevento->getid();
            $param["nombre"]=$objevento->getnombre();
            $param["detalle"]=$objevento->getdetalle();
            $param["cantentrada"]=$nuevoEntrada;
            $param["importe"]=$objevento->getimporte();
            $param["imagen"]=$objevento->getimagen();

        $AbmEvento=new AbmEvento();

        if($AbmEvento->modificacion($param)){
            $actualizado=true;
        } 


        return $actualizado;

        
    }


    // si cancelamos un items, se devuelve(sumar) la cantidad pedida al entrada del evento
    /*public function devolverEntrada($objItem){


        $cantidadPedida=$objItem->getCiCantidad();
        $objevento=$objItem->getObjevento();

        $this->actualizarEntrada($objevento,$cantidadPedida,'sumar');

    }*/
}