<?php

include_once '../../../configuracion.php';

if(!empty($_GET['idinscripcion'])){
    $id=$_GET['idinscripcion'];

}
?>

<form method="get" action="../inscripcions/admin/aceptainscripcion.php">
    <input type="hidden" name="idinscripcion" id="idinscripcion" value="<?php echo $id;?>">



    <div class="modal-footer">
        <button type="submit"  class="btn btn-success">Aceptar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
    </div>

</form>