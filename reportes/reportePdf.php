<?php
require_once 'mpdf/MPDF57/mpdf.php';
//rutcliente = $_GET['id'];

$mpdf = new mPDF('c', 'A4');
/*
if ($rows = mysqli_fetch_array($this->model->HistorialVisitarut($rutcliente))) :
foreach ($this->model->HistorialVisitarut($rutcliente) as $rows) :
  $fechavisita = $rows['fecha_ficha'];
  $obsvisita = strtoupper($rows['observacion_ficha']);
endforeach;
else :
$obsvisita .= 'CLIENTE SIN OBSERVACIONES PREVIAS...';
endif;

if ($rows1 = mysqli_fetch_array($this->model->infoClienteCompletarut($rutcliente))) :
    foreach ($this->model->infoClienteCompletarut($rutcliente) as $rows1) :
      $rutcli = $rows1['rut_cliente'].'- '.$rows1['dv_cliente'];
      $nombre = strtoupper($rows1['nombres_cliente']).' '.strtoupper($rows1['apellidop_cliente']).' '.strtoupper($rows1['apellidom_cliente']);
      $fecnac = $rows1['fechanac_cliente'];
      $edad = $rows1['edad_actual'].' AÑO(S) '.$rows1['meses_actual'].' MES(ES) '.$rows1['dias_actual'].' DÍA(S)';
      $sexo = $rows1['descripcion_sexo'];
      $hijos = $rows1['hijos_cliente'];
      $fono = $rows1['telefono_cliente'];
      $direcc = $rows1['direccion_cliente'].' / '.$rows1['numcasa_cliente'];
      $correo = strtoupper($rows1['correo_cliente']);
      $comuna = strtoupper($rows1['descripcion_comuna']);
      $prevision = strtoupper($rows1['descripcion_prevision']);
      $fondo = strtoupper($rows1['descripcion_tipoprevision']);
      $tipoprev = strtoupper($rows1['descripcion_tipopension']);
    endforeach;
    else :
    $obsvisita .= 'CLIENTE SIN OBSERVACIONES PREVIAS...';
    endif;
*/
$html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
    .small {
        font-size: xx-small;
        padding: 0;
        vertical-align: baseline;
        padding: 2px;
        border-width: 1px;
        border-style: solid;
        border-color: #ADC9E4;
        padding-left: 10px;
        padding-right: 10px;
        height: 18px;
        font-size: 11px;
    }
</style>
</style>
<div style="text-align:center; "><h4>REPORTE DE CLIENTE</h4></div>
<div style="text-align:left; " style="font-size:12;"><b>EMITIDO POR:</b>  '. strtoupper(base64_decode( $_SESSION['nombreUsuario'])) .' '. strtoupper(base64_decode($_SESSION['apellidoUsuario'])).'</div>
<div style="text-align:left; "  style="font-size:12;"><b>FECHA EMISIÓN:</b> '. date('d-m-Y H:m').'</div>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" bgcolor="#c4ebfa" class="small"><span style="font-size:14px;"><b>DATOS PERSONALES</b></span></td>
    </tr>
    <tr>
        <td width="26%" class="small"><b>R.U.T</b></td>
        <td width="74%" class="small">19191919191</td>
    </tr>
    <tr>
        <td class="small"><b>NOMBRES</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>FECHA NACIMIENTO</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>EDAD ACTUAL</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>SEXO</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>CANTIDAD DE HIJOS</b></td>
        <td class="small"></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" bgcolor="#c4ebfa" class="small"><span style="font-size:14px;"><b>CONTACTO</b></span></td>
    </tr>
    <tr>
        <td width="26%" class="small"><b>TELEFONO</b></td>
        <td width="74%" class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>CALLE / N° CASA</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>CORREO</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>COMUNA</b></td>
        <td class="small"></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" bgcolor="#c4ebfa" class="small"><span style="font-size:14px;"><b>PENSIONES</b></span></td>
    </tr>
    <tr>
        <td width="26%" class="small"><b>FONDO DE PENSION</b></td>
        <td width="74%" class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>DETALLE FONDO</b></td>
        <td class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>TIPO DE PENSION</b></td>
        <td class="small"></td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" bgcolor="#c4ebfa" class="small"><span style="font-size:14px;"><b>ULTIMA VISITA</b></span></td>
    </tr>
    <tr>
        <td width="26%" class="small"><b>FECHA</b></td>
        <td width="74%" class="small"></td>
    </tr>
    <tr>
        <td class="small"><b>OBSERVACION</b></td>
        <td class="small"></td>
    </tr>
</table>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
echo $html;
