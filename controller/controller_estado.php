<?php
session_start();
/*if (isset($_SESSION['nombreUsuario'])) {

} else {
header('Location: index.html');
}*/
date_default_timezone_set('America/Santiago');
require_once 'model/model_estado.php';

class EstadoController
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

        $this->model       = new EstadoModel();
        $this->datetime    = date('Y-m-d H:i:s');
        $this->date        = date('Y-m-d');
        $this->time        = date('H:i:s');
        $this->controller  = "estado";
        $this->seccion     = "Estado";
        $this->subseccion  = "Parametros";
        $this->lista       = "Estados";

        //URL ENRUTADOR
        $this->urlhome     = './view.php?c=dashboard';
        $this->urladd      = './view.php?c=' . $this->controller . '&a=add';
        $this->urledit     = './view.php?c=' . $this->controller . '&a=edit&id=';
        $this->urlsave     = './view.php?c=' . $this->controller . '&a=save';
        $this->urldelete   = './view.php?c=' . $this->controller . '&a=delete&id=';
        $this->urlupdate   = './view.php?c=' . $this->controller . '&a=update';
        $this->urlstatus   = './view.php?c=' . $this->controller . '&a=status&id=';
        $this->urlload     = '';
        $this->urllist     = './view.php?c=' . $this->controller;
        $this->urlfile     = '';
        $this->urldownload = '';
        $this->urlultimo   = './view.php?c=' . $this->controller . '&a=ultimo';
        $this->urltable    = './view.php?c=' . $this->controller . '&a=table';
    }

    public function index()
    {
        $condicion = "  order by id_estado desc";
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function table()
    {
        $condicion = "  order by id_estado desc";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

}
