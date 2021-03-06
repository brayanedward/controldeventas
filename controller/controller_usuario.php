<?php
session_start();
/*if (isset($_SESSION['nombreUsuario'])) {

} else {
header('Location: index.html');
}*/
date_default_timezone_set('America/Santiago');
require_once 'model/model_usuario.php';
require_once 'model/model_tipoUsuario.php';

class UsuarioController
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

        $this->model      = new UsuarioModel();
        $this->modelTipoUsuario      = new tipoUsuarioModel();
        $this->datetime   = date('Y-m-d H:i:s');
        $this->date       = date('Y-m-d');
        $this->time       = date('H:i:s');
        $this->controller = "usuario";
        $this->seccion    = "Usuario";
        //$this->subseccion = "Maestros";
        $this->lista      = "Usuarios";

        //URL ENRUTADOR
        $this->urlhome     = './view.php?c=usuario';
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
        require_once './view/usuario/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function table(){
        $condicion = " where estado_usuario < 3 order by nombre_usuario desc";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

    public function ultimo(){
        $condicion = " where estado_usuario < 3 order by rut_usuario desc limit 10";
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
            $condicion = " where rut_usuario='" . $id . "'";
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
            $condicion = " where rut_usuario='" . $id . "'";
            $this->model->set("condicion", $condicion);
        }

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/edit2_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function status(){
        $id        = base64_decode($_REQUEST['id']);
        $condicion = " where rut_usuario='" . $id . "'";
        $this->model->set("condicion", $condicion);
        if ($rows = mysqli_fetch_array($this->model->lista())) {
            if ($rows['estado_usuario'] == 1) {
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
        header('Location: ./view.php?c=usuario');
        //$this->index();
    }

    public function save(){
        $rut = stripslashes($_REQUEST['txtRutUsuario']);
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
        $this->model->set("nombre", $_REQUEST['txtNombreUsuario']);
        $this->model->set("apellidop", $_REQUEST['txtApellidoP']);
        $this->model->set("correo", $_REQUEST['txtCorreoElectronico']);
        $this->model->set("tipo", $_REQUEST['tipoUsuario']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("estado", 1);

        if ($query = $this->model->add()) {
            echo "1";
        } else {
            echo "2";
        }
    }

    public function update(){

        $rut = stripslashes($_REQUEST['txtRutUsuario']);
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
        $this->model->set("nombre", $_REQUEST['txtNombreUsuario']);
        $this->model->set("apellido", $_REQUEST['txtApellidoP']);
        $this->model->set("correo", $_REQUEST['txtCorreoElectronico']);
        $this->model->set("estado", 1);
        $this->model->set("tipo", $_REQUEST['tipoUsuario']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("idusu", $_REQUEST['idusu']);

        if ($query = $this->model->edit()) {
            echo 1;
        } else {
            echo 2;
        }
    }

    public function update2(){

        $rut = stripslashes($_REQUEST['txtRutUsuario']);
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
        $this->model->set("nombre", $_REQUEST['txtNombreUsuario']);
        $this->model->set("apellido", $_REQUEST['txtApellidoP']);
        $this->model->set("correo", $_REQUEST['txtCorreoElectronico']);
        $this->model->set("tipo", $_REQUEST['tipoUsuario']);
        $this->model->set("password", $_REQUEST['txtPassword']);
        $this->model->set("estado", 1);
        $this->model->set("idusu", $_REQUEST['idusu']);

        if ($query = $this->model->edit()) {
            echo 1;
            $_SESSION['nombreUsuario'] = base64_encode($_REQUEST['txtNombreUsuario']);
            $_SESSION['apellidoUsuario'] = base64_encode($_REQUEST['txtApellidoP']);
            $_SESSION['tipoUsuario'] = base64_encode($_REQUEST['tipoUsuario']);
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
        $this->model->set("rut_usuario", $id);
        $query = $this->model->cambiaPw();
    }
}
