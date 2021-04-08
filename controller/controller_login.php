<?php
session_start();
date_default_timezone_set('America/Santiago');
require_once 'model/model_usuario.php';

class LoginController
{
    private $model;
    private $datetime;
    private $controller;
    private $seccion;
    private $lista;
    private $modelFkrol;

    public function __construct()
    {

        $this->model      = new UsuarioModel();
        $this->datetime   = date('Y-m-d H:i:s');
        $this->controller = "login";

    }

    public function login()
    {

        $username = stripslashes($_POST['username']);
        $username = addslashes($username);
        $username = trim($username);
        //$rut = mysql_escape_string($rut);
        $username = htmlspecialchars($username);
        $username = str_replace('"', '', $username);
        $username = str_replace(':', '', $username);
        $username = str_replace('.', '', $username);
        $username = str_replace(',', '', $username);
        $username = str_replace(';', '', $username);

        //corte de rut
        $position = explode("-", $username);
        $username = $position[0];
        $dv       = $position[1];
        //obtenemos los datos de login

        $username = addslashes($username);
        $username = stripslashes($username);
        $username = rtrim($username);
        $username = trim($username);
        $username = htmlspecialchars($username);
        $username = str_replace('"', '', $username);
        $username = str_replace("'", '', $username);
        $password = $_POST['password'];
        $password = addslashes($password);
        $password = stripslashes($password);
        $password = rtrim($password);
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = str_replace('"', '', $password);
        $password = str_replace("'", '', $password);
        //generamos la condicion de busqueda
        $condicion = " where estado_usuario = 1 and rut_usuario = '" . $username . "' and password_usuario='" . $password . "'";
        $this->model->set("condicion", $condicion);
        if ($rows = mysqli_fetch_assoc($this->model->lista())) {

            $_SESSION['rutUsuario']       = base64_encode($rows['rut_usuario']);
            $_SESSION['dvUsuario']        = base64_encode($rows['dv_usuario']);
            $_SESSION['nombreUsuario']    = base64_encode($rows['nombres_usuario']);
            $_SESSION['apellidoPaterno']  = base64_encode($rows['apellidoPaterno_usuario']);
            $_SESSION['apellidoMaterno']  = base64_encode($rows['apellidoMaterno_usuario']);
            $_SESSION['estadoUsuario']       = base64_encode($rows['estado_usuario']);
            $_SESSION['passwordUsuario']  = base64_encode($rows['password_usuario']);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function logout()
    {
        session_destroy();
        if (!isset($_SESSION['rutUsuario'])) {

        } else {
            header('Location: ./index.php');
        }
    }

}
