<?php
session_start();
/*if (isset($_SESSION['nombrereporte'])) {

} else {
header('Location: index.html');
}*/
date_default_timezone_set('America/Santiago');
require_once 'model/model_reporte.php';
require_once 'model/model_tipoPago.php';
require_once 'model/model_tipoUsuario.php';
require_once 'model/model_usuario.php';
require_once 'model/model_venta.php';
//require_once 'model/model_rol.php';

class ReporteController
{
    private $model;
    private $datetime;
    private $date;
    private $time;
    private $controller;
    private $seccion;
    private $subseccion;
    private $lista;

    private $urlhome;
    private $urladd;
    private $urledit;
    private $urlsave;
    private $urldelete;
    private $urlupdate;
    private $urlstatus;
    private $urlload;
    private $urllist;
    private $urlfile;
    private $urldownload;
    private $urlultimo;
    private $urltable;

    public function __construct()
    {

        $this->model      = new reporteModel();
        $this->modelTipoPago = new tipoPagoModel();
        $this->modelTipoUsuario = new tipoUsuarioModel();
        $this->modelUsuario = new UsuarioModel();
        $this->modelVenta = new VentaModel();
        $this->datetime   = date('Y-m-d H:i:s');
        $this->date       = date('Y-m-d');
        $this->time       = date('H:i:s');
        $this->controller = "reporte";
        $this->seccion    = "reporte";
        //$this->subseccion = "Maestros";
        $this->lista      = "reportes";

        //URL ENRUTADOR
        $this->urlhome     = './view.php?c=reporte';
        $this->urladd      = './view.php?c=' . $this->controller . '&a=add';
        $this->urledit     = './view.php?c=' . $this->controller . '&a=edit&id=';
        $this->urledit2     = './view.php?c=' . $this->controller . '&a=edit&id=';
        $this->urlsave     = './view.php?c=' . $this->controller . '&a=save';
        $this->urldelete   = './view.php?c=' . $this->controller . '&a=delete&id=';
        $this->urlupdate   = './view.php?c=' . $this->controller . '&a=update';
        $this->urlupdate2   = './view.php?c=' . $this->controller . '&a=update2';
        $this->urlstatus   = './view.php?c=' . $this->controller . '&a=status&id=';
        $this->urlload     = '';
        $this->urllist     = './view.php?c=' . $this->controller;
        $this->urlfile     = '';
        $this->urldownload = '';
        $this->urlultimo   = './view.php?c=' . $this->controller . '&a=ultimo';
        $this->urltable    = './view.php?c=' . $this->controller . '&a=table';
        $this->urlchpass   = './view.php?c=' . $this->controller . '&a=cambiapassword';
        $this->generaPDF      = './view.php?c=' . $this->controller . '&a=generaPDF';
        $this->listaxfiltro      = './view.php?c=' . $this->controller . '&a=listaxfiltro';
    }

    public function index(){
        $condicion = "";
        $condicionUsuario = 'order by nombre_usuario asc';
        $this->modelUsuario->set("condicion",$condicionUsuario);
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/reporte/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function lista(){
        $condicion = "";
        $condicionUsuario = 'order by nombre_usuario asc';
        $this->modelVenta->set("condicion",$condicionUsuario);
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/reporte/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }


    public function listaxfiltro(){
        $fecha1 = explode('-',$_REQUEST['txtFechaDesde']);
        $fechaDesde  = $fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];
        $fechaHasta = explode('-',$_REQUEST['txtFechaHasta']);
        $fechaHasta  = $fechaHasta[2].'-'.$fechaHasta[1].'-'.$fechaHasta[0];
        $tipoPago = $_REQUEST['tipoPago'];
        $tipoUsuario = $_REQUEST['tipoUsuario'];
        $vendedor = $_REQUEST['usuario'];
        $retorno='';
        $condicionVenta = '';
        if($fechaDesde != '' && $fechaHasta != ''){
          $condicionVenta = 'AND fechaUsuario_venta BETWEEN "'.$fechaDesde.' 00:00:00" AND "'.$fechaHasta.' 23:59:59" ';
        }else{
          if($fechaDesde){
            $condicionVenta = 'AND fechaUsuario_venta = "'.$fechaDesde.'" ';
          }else if($fechaHasta){
            $condicionVenta = 'AND fechaUsuario_venta = "'.$fechaDesde.'" ';
          }else{
            $fecha = date('d-m-Y'); //HOY
            $condicionVenta = 'AND fechaUsuario_venta = "'.$fecha.'"  ';
          }
        }

        if($tipoPago<3){
            $condicionVenta.= 'AND a.tipoPago_venta='.$tipoPago.' ';
        }

        if($tipoUsuario<3){
            $condicionVenta.= 'AND a.tipoUsuario_venta='.$tipoUsuario.' ';
        }
        if($vendedor!=3){
            $condicionVenta.= 'AND a.usuario_venta='.$vendedor.' ';
        }

        $this->modelVenta->set("condicion", $condicionVenta);

        if ($rows = mysqli_fetch_array($this->modelVenta->lista())) :
            foreach ($this->modelVenta->lista() as $rows) :
    $retorno = '<tr>
                    <th data-org-colspan="1" data-columns="tech-companies-1-col-0"><span class="co-name">' . $rows['fechaUsuario_venta'] . '</span></th>
                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['id_venta'] . '</td>
                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['nombre_usuario'] . ' ' . $rows['apellido_usuario'] . '</td>
                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['cliente_venta'] . '</td>
                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">$' . $rows['valor_venta'] . '/ N° Casa:</td>
                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['descripcion_tipoPago'] . '</td>
                </tr>';
            endforeach;
        else :
            $retorno .= '<tr><th data-org-colspan="1" colspan="7" data-columns="tech-companies-1-col-0"><b>No se encontraron ventas registradas con los parametros de búsqueda actual</b></th></tr>';
        endif;

        echo $retorno;

    }
}
