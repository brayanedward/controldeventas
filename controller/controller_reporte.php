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
    }

    public function index(){
        $condicion = "";
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/reporte/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function table(){
        $condicion = " where estado_reporte < 3 order by nombre_reporte desc";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

    public function ultimo(){
        $condicion = " where estado_reporte < 3 order by rut_reporte desc limit 10";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/rows_' . $this->controller . '.php';
    }


    public function delete(){
        $id = base64_decode($_REQUEST['id']);
        $this->model->set("rut", $id);
        $this->model->set("estado", 3);
        $query = $this->model->delete();
    }

    public function deshabilitar(){
        $id = base64_decode($_REQUEST['id']);
        $this->model->set("rut", $id);
        $this->model->set("estado", 2);
        $query = $this->model->estado();
    }

    public function cambiapassword(){
        $id = $_REQUEST['idusu'];
        $pass1 = $_REQUEST['pass1'];
        $this->model->set("pass", $pass1);
        $this->model->set("rut_reporte", $id);
        $query = $this->model->cambiaPw();
    }
}
