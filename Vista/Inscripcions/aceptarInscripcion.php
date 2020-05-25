<?php

if(!empty($_GET['idinscripcion'])){
    $id=$_GET['idinscripcion'];

}
?>

<form method="get" action="../principal/principal.php">
    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
    <input type="hidden" name="controller" id="controller" value="AbmInscripcion">
    <input type="hidden" name="action" id="action" value="alta">
    <div class="modal-footer">
        <button type="submit"  class="btn btn-success">Aceptar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
    </div>

</form>