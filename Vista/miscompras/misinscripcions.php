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
$cliente=new Cliente();
$inscripcions=$cliente->misinscripcions();

?>
<div class="container">
    <table class="table table-hover">
        <thead>
        <th>ID inscripcion</th>

        <th>Estado</th>
        <th>Fecha inscripcion</th>
        <th>Opciones</th>
        </thead>
        <tbody>
        <?php
        foreach($inscripcions as $inscripcion){
            $estado=$cliente->ultimoEstadoinscripcion($inscripcion->getidinscripcion());
            ?>
            <tr>
                <td><?php echo $inscripcion->getidinscripcion();?></td>

                <td><?php echo  $estado;?></td>

                <td><?php echo $inscripcion->getCofecha();?></td>
                <?php

                if($estado=='iniciada' or $estado=='enviada'){
                    ?>
                    <td><a href="accion/cancelarinscripcion.php?idinscripcion=<?php echo $inscripcion->getidinscripcion();?>" class="btn btn-danger btn-sm" >Cancelar</a></td>
                <?php
                }

                ?>


                <td><a class="btn btn-info btn-sm" style="color:white" href="../principal/pdf/detalles.php?idinscripcion=<?php echo $inscripcion->getidinscripcion();?>">Ver Detalles</a></td>
            </tr> 

            <?php
        }
        ?>
        </tbody>

    </table>
</div>


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
</body>
</html>