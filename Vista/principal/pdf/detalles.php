<?php
require_once '../../../configuracion.php';
$idinscripcion=$_GET['idinscripcion'];

$AbmInscripcion=new AbmInscripcion();
$inscripcions=$AbmInscripcion->buscar(['idinscripcion'=>$idinscripcion]);
$inscripcion=$inscripcions[0];


$inscripcionEstado=new AbmInscripcionestado();
$param=['idinscripcion'=>$idinscripcion];
$arregloinscripcionEstadoDeLainscripcion=$inscripcionEstado->buscar($param);


$param=['idinscripcion'=>$idinscripcion];

$AbmInscripcionitem=new AbmInscripcionitem();


$coleccioninscripcion=$AbmInscripcionitem->buscar($param);

?>
<?php
require '../../../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
try{
    ob_start();
    require_once 'vista.php';
    $html=ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','en', false, 'UTF-8');
    //$html2pdf->setDefaultFont('Arial');

    $html2pdf->writeHTML($html);
    $html2pdf->output('Detalle inscripcion '.$idinscripcion.'.pdf', 'D');
}catch (Html2PdfException $e){
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

