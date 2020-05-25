

$(document).ready(function() {

    $('[data-inscripcioncan]').on('click',function(e){
        e.preventDefault();

        var id=$(this).data('inscripcioncan');
        $('.modal-body').load('../inscripcions/cancelarinscripcion.php?idinscripcion='+id,function(){
            $('#cancelarinscripcion').modal('show');

        });


    });

});
$(document).ready(function() {

    $('[data-inscripcionacep]').on('click',function(e){
        e.preventDefault();

        var id=$(this).data('inscripcionacep');
        $('.modal-body').load('../inscripcions/aceptarinscripcion.php?idinscripcion='+id,function(){
            $('#aceptarinscripcion').modal('show');

        });


    });

});