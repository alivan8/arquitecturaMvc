<?php

include_once '../../configuracion.php';

if(!empty($_GET['id'])){
    $id=$_GET['id'];

    $param=['id'=>$id];

    $evento=new AbmEvento();

    $arregloeventos=$evento->buscar(['id'=>$id]);
    $evento=$arregloeventos[0];


}
?>



<form method="get" action="../carrito/accion/agregareventocarro.php">
    <input name="precio" id="precio" type="hidden" value="<?php echo $evento->getimporte();?>">
    <input name="id" id="id" type="hidden" value="<?php echo $id;?>">
    <p style="font-size: 20px"><strong><?php echo $evento->getnombre();?></strong></p>


    <span><?php echo $evento->getdetalle();?></span>
    <br>
    <br>
    <img src="<?php echo $evento->getimagen();?>" width="180px">
    <br>
    <br>
    <p style="font-size: 15px"><strong id="precio">Importe $ <?php echo $evento->getimporte();?></strong></p>

    <div class="form-group">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" id="cantidad" min="1" max="<?php echo $evento -> getcantentrada() ?>">

    </div>





    <strong style="display: inline">Total: $</strong>
    <div id="total" style="display: inline;">

    </div>

    <div class="modal-footer">
        <button type="submit"  class="btn btn-info">Agregar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    </div>

</form>




<script>

    $(document).ready(function() {

        $( "#cantidad" ).keyup(function() {
            var total=0;
            var precio=200;
            var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();
            total+=cantidad*precio;
            //var cantidad=document.getElementById('cantidad').value;
            $('#total').html(total);
        });




    });


</script>
