<?php

include_once '../../configuracion.php';


$menu=new AbmMenu();
$arregloMenu=$menu->buscar(null);

$menuRol=new AbmMenurol();
$listaMenuRol=$menuRol->buscar(null);

$usuRol=new AbmUsuariorol();

$session=new Session();
$inactivo=false;

$arreglo = explode('/', $_SERVER['PHP_SELF']);

$total = count($arreglo);
$archivo = strtolower($arreglo[$total - 1]);

if(!$session->activa()){

    $inactivo=true;

    $variableMenuUsuario='entrar';

    if($archivo != 'principal.php'){
        header('Location: ../principal/login.php');
    }

}else{

    $idUsu = $session->getUsuario()->getIdusuario();
    $nombreUsuario = $session->getUsuario()->getUsnombre();
    $variableMenuUsuario =  $nombreUsuario;

    $param=array('idusuario' => $idUsu);
    $objRolUsuario = $usuRol->buscar($param);

    $rolUsu = $objRolUsuario[0] -> getObjRol() -> getIdRol();

    $encontrado = puedoEntrar($rolUsu,$listaMenuRol,$archivo,$arregloMenu);

    if(!$encontrado){
        session_destroy();
        header('Location: ../principal/login.php');
    }

}

//si esta en la ventana correcta

function puedoEntrar($rolUsu,$listaMenuRol,$archivo,$arregloMenu){
    $i = 0;
    $encontrado = false;
    $salir = false;

    if ($archivo == 'principal.php') {
        $salir = true;
        $encontrado = true;
    }

    while ($i < count($arregloMenu) and !$salir) {

        $menu = $arregloMenu[$i];
        $ruta = $menu->getMenombre();
        $ruta = strtolower($ruta . ".php");
        $i++;

        if (esRol($rolUsu, $menu, $listaMenuRol)) {
            if ($archivo == $ruta) {

                $encontrado = true;
                $salir = true;

            }
        }
    }
    return $encontrado;
}

function esRol($rolUsu,$menu,$menuRol){
    $resp=false;
    foreach($menuRol as $rol){
        if($rol->getObjmenu() == $menu and $rol->getObjRol()->getIdRol() == $rolUsu){
            $resp=true;
        }
    }
    return $resp;
}

function esPadre($menu,$arreglo){
    $idMenu=$menu->getIdmenu();
    $esPadre=false;
    $i=0;
    while($i<count($arreglo)){
        if(!($arreglo[$i]->getObjMenu() == null)) {
            if ($arreglo[$i]->getObjMenu()->getIdmenu() == $idMenu) {
                $esPadre = true;

            }
        }
        $i++;
    }
    return $esPadre;
}

?>


<nav class="site-header sticky-top py-1" xmlns="http://www.w3.org/1999/html">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="/Arquitectura/proyecto-MVC/Vista/principal/principal.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        </a>


        <?php
        if (!$inactivo) {
            foreach ($arregloMenu as $menu) {
                $esPadre = esPadre($menu, $arregloMenu);
                $rolCorrecto = esRol($rolUsu, $menu, $listaMenuRol);
                if ($rolCorrecto) {
                    if ($esPadre) {
                        ?>
                        <div class="dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            <?php echo ucfirst($menu->getMenombre()); ?>
                        </button>
                        <div class="dropdown-menu"><?php
                            foreach ($arregloMenu as $otroMenu) {
                                $esRol = esRol($rolUsu, $otroMenu, $listaMenuRol);
                                if($esRol and $otroMenu -> getMedeshabilitado() == null) {
                                    if (!($otroMenu->getObjMenu() == null)) {
                                        if ($menu->getIdmenu() == $otroMenu->getObjMenu()->getIdmenu()) {
                                            $var1=strtolower($menu->getMenombre());
                                            $var2=ucfirst($otroMenu->getMenombre());
                                            ?>
                                            <a class="dropdown-item"
                                               href="../<?php echo strtolower($menu->getMenombre()) ?>/<?php echo strtolower($otroMenu->getMenombre()) ?>.php"><?php echo ucfirst($otroMenu->getMenombre()); ?></a>

                                            <?php

                                        }
                                    }
                                }
                            }
                            ?></div></div><?php
                    } else {
                        if ($menu->getObjMenu() == null and $menu -> getMedeshabilitado() == null) {
                            ?>
                            <li class="nav-item">
                                <a class="py-2 d-none d-md-inline-block "
                                   href="../<?php echo $menu->getMenombre() ?>/<?php echo $menu->getMenombre() . '.php' ?>"><?php echo ucfirst($menu->getMenombre()); ?></a>
                            </li>
                            <?php
                        }
                    }
                }

            }
        }
        ?>
        <div>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                <?php

                echo ucfirst($variableMenuUsuario);


                ?>
            </button>
            <div class="dropdown-menu">
                <?php
                if(isset($nombreUsuario)){

                    ?>
                    <a class="dropdown-item" href="../principal/perfil.php">Editar Perfil</a>

                    <a class="dropdown-item" href="../principal/accion/cerrarsesion.php">Cerrar Sesion</a>

                    <?php
                }
                else{
                    ?>
                    <a class="dropdown-item" href="../principal/login.php">Iniciar Sesion</a>

                    <a class="dropdown-item" href="../principal/nuevousuario.php">¿Sos nuevo? Registrate</a>

                    <?php
                }
                ?>




            </div>
        </div>



</nav>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>