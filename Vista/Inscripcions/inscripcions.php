<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/estilos.css" rel="stylesheet">
    <title>inscripcions</title>
</head>
<body>
<?php
include_once '../estructura/encabezado.php';
$admin=new Admin();
$inscripcions=$admin->inscripcionsPendientes();

?>
<div class="container">
    <table class="table table-hover table-striped">
        <thead>
        <th>ID inscripcion</th>
        <th>Usuario</th>
        <th>Email Usuario</th>
        <th>Fecha inscripcion</th>
        <th>Estado</th>
        <th>Opciones</th>
        </thead>
        <tbody>
        <?php
            foreach($inscripcions as $inscripcion){
                $estadoinscripcion=$admin->verificaEstadoinscripcion($inscripcion->getidinscripcion());
                ?>
                <tr class="<?php if($estadoinscripcion==4){echo 'table-danger';} elseif ($estadoinscripcion==2){echo 'table-success';} ?>">

                    <td><?php echo $inscripcion->getidinscripcion();?></td>
                    <td><?php echo $inscripcion->getObjUsuario()->getUsnombre();?></td>
                    <td><?php echo $inscripcion->getObjUsuario()->getUsmail();?></td>
                    <td><?php echo $inscripcion->getCofecha();?></td>
                    <td><?php echo $estadoinscripcion;?></td>

                    <?php

                    // si la inscripcion ya fue cancelada
                     if($estadoinscripcion==4 or $estadoinscripcion==2){

                         ?>
                         <td><button class="btn btn-info btn-sm"><a style="color: white" href="..l/pdf/detalles.php?idinscripcion=<?php echo $inscripcion->getidinscripcion();?>">Detalles</a></button></td>
                    <?php

                     }if($admin->verificaEstadoinscripcion($inscripcion->getidinscripcion())==3 ){
                         ?>
                        <td><button class="btn btn-info btn-sm"><a style="color: white" href="../principal/pdf/detalles.php?idinscripcion=<?php echo $inscripcion->getidinscripcion();?>">Detalles</a></button></td>
                         <td><button class="btn btn-danger btn-sm" data-inscripcioncan="<?php echo $inscripcion->getidinscripcion();?>">Cancelar</button></td>
                         <td><button class="btn btn-success btn-sm" data-inscripcionacep="<?php echo $inscripcion->getidinscripcion();?>">Aceptar</button></td>
                    <?php

                     }
                    ?>


                </tr>

        <?php
            }
        ?>
        </tbody>

    </table>
    <hr>
</div>
<div class="modal" tabindex="-1" role="dialog" id="cancelarinscripcion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea Cancelar la inscripcion?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="aceptarinscripcion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Esta Seguro que desea aceptar la inscripcion?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<?php

include_once '../estructura/pie.php';



?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
<script src="../js/admin.js"></script>
</body>
</html>