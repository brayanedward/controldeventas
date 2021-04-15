<?php
session_start();
/*if (isset($_SESSION['nombreventa'])) {

} else {
header('Location: index.html');
}*/
date_default_timezone_set('America/Santiago');
require_once 'model/model_venta.php';
//require_once 'model/model_rol.php';

class VentaController
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

        $this->model      = new VentaModel();
        $this->datetime   = date('Y-m-d H:i:s');
        $this->date       = date('Y-m-d');
        $this->time       = date('H:i:s');
        $this->controller = "venta";
        $this->seccion    = "venta";
        //$this->subseccion = "Maestros";
        $this->lista      = "ventas";

        //URL ENRUTADOR
        $this->urlhome     = './view.php?c=venta';
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
        require_once './view/venta/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function table(){
      if(base64_decode($_SESSION['tipoUsuario'])==1){
        $condicion = " where estado_venta < 3 order by nombre_venta desc";
      }else {
        $usuario = base64_decode($_SESSION['rutUsuario']);
        $condicion = " where estado_venta < 3 and usuario_venta = $usuario order by nombre_venta desc";
      }
        $condicion = " where estado_venta < 3 order by nombre_venta desc";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

    public function ultimo(){
        $condicion = " where estado_venta < 3 order by rut_venta desc limit 10";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/rows_' . $this->controller . '.php';
    }

    public function add(){
        //$condicionRol = " where estado_rol < 3 order by id_rol desc";
        //$this->modelRol->set("condicion", $condicionRol);

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/add_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function edit(){
        $id = base64_decode($_REQUEST['id']);
        if (isset($id)) {
            $condicion = " where rut_venta='" . $id . "'";
            $this->model->set("condicion", $condicion);
        }

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/edit_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function edit2(){
        $id = base64_decode($_REQUEST['id']);
        if (isset($id)) {
            $condicion = " where rut_venta='" . $id . "'";
            $this->model->set("condicion", $condicion);
        }

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/edit2_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function status(){
        $id        = base64_decode($_REQUEST['id']);
        $condicion = " where estado_venta = 1 and rut_venta='" . $id . "'";
        $this->model->set("condicion", $condicion);
        if ($rows = mysqli_fetch_array($this->model->lista())) {
            if ($rows['estado_venta'] == 1) {
                $this->model->set("estado", 2);
            } else {
                $this->model->set("estado", 1);
            }
        }
        $this->model->set("id", $id);

        if ($query = $this->model->estado()) {
            echo 1;
        } else {
            echo 2;
        }
        header('Location: ./view.php?c=venta');
        //$this->index();
    }

    public function save(){
        $rut = stripslashes($_REQUEST['txtRutventa']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $position = explode("-", $rut);
        $rut      = $position[0];
        $dv       = $position[1];

        $this->model->set("rut", $rut);
        $this->model->set("dv", $dv);
        $this->model->set("nombre", $_REQUEST['txtNombreventa']);
        $this->model->set("apellidop", $_REQUEST['txtApellidoP']);
        $this->model->set("apellidom", $_REQUEST['txtApellidoM']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("estado", 1);

        if ($query = $this->model->add()) {
            echo "1";
        } else {
            echo "2";
        }
    }

    public function update(){

        $rut = stripslashes($_REQUEST['txtRutventa']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $position = explode("-", $rut);
        $rut      = $position[0];
        $dv       = $position[1];

        $this->model->set("rut", $rut);
        $this->model->set("dv", $dv);
        $this->model->set("nombre", $_REQUEST['txtNombreventa']);
        $this->model->set("apellidop", $_REQUEST['txtApellidoP']);
        $this->model->set("apellidom", $_REQUEST['txtApellidoM']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("estado", 1);
        $this->model->set("idusu", $_REQUEST['idusu']);

        if ($query = $this->model->edit()) {
            echo 1;
        } else {
            echo 2;
        }
    }

    public function update2(){

        $rut = stripslashes($_REQUEST['txtRutventa']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $position = explode("-", $rut);
        $rut      = $position[0];
        $dv       = $position[1];

        $this->model->set("rut", $rut);
        $this->model->set("dv", $dv);
        $this->model->set("nombre", $_REQUEST['txtNombreventa']);
        $this->model->set("apellidop", $_REQUEST['txtApellidoP']);
        $this->model->set("apellidom", $_REQUEST['txtApellidoM']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("estado", 1);
        $this->model->set("idusu", $_REQUEST['idusu']);

        if ($query = $this->model->edit()) {
            echo 1;
            $_SESSION['nombreventa'] = base64_encode($_REQUEST['txtNombreventa']);
            $_SESSION['apellidoPaterno'] = base64_encode($_REQUEST['txtApellidoP']);
            $_SESSION['apellidoMaterno'] = base64_encode($_REQUEST['txtApellidoM']);
        } else {
            echo 2;
        }
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
        $this->model->set("rut_venta", $id);
        $query = $this->model->cambiaPw();
    }
}
