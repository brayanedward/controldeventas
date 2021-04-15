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
        $this->infoventa   = './view.php?c=' . $this->controller . '&a=infoVenta';
    }

    public function index(){
      if(base64_decode($_SESSION['tipoUsuario'])==1){
        $condicion = " and a.estado_venta < 3 order by a.fechaUsuario_venta desc";
      }else {
        $usuario = base64_decode($_SESSION['rutUsuario']);
        $condicion = " and a.estado_venta < 3 and a.usuario_venta = ".$usuario." order by a.fechaUsuario_venta desc";
      }
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/venta/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function table(){
        $condicion= '';
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

    public function ultimo(){
        $condicion = " where estado_venta < 3 order by rut_venta desc limit 10";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/rows_' . $this->controller . '.php';
    }

    public function add(){

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/venta/add_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function edit(){
        $id = base64_decode($_REQUEST['id']);
        if (isset($id)) {
            $condicion = " and id_venta='" . $id . "'";
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
        $this->model->set("txtValorventa", $_REQUEST['txtValorventa']);
        $this->model->set("txtFechaventa", $_REQUEST['txtFechaventa']);
        $this->model->set("txtNombrecventa", $_REQUEST['txtNombrecventa']);
        $this->model->set("txtDireccioventa", $_REQUEST['txtDireccioventa']);
        $this->model->set("selTipopago", $_REQUEST['selTipopago']);
        $this->model->set("txtDetalleventa", $_REQUEST['txtDetalleventa']);
        $this->model->set("usuario", base64_decode($_SESSION['rutUsuario']));
        $this->model->set("estado", 1);

        if ($query = $this->model->add()) {
            echo '1';
        } else {
            echo '2';
        }
    }

    public function update(){
        $this->model->set("txtValorventa", $_REQUEST['txtValorventa']);
        $this->model->set("txtFechaventa", $_REQUEST['txtFechaventa']);
        $this->model->set("txtNombrecventa", $_REQUEST['txtNombrecventa']);
        $this->model->set("txtDireccioventa", $_REQUEST['txtDireccioventa']);
        $this->model->set("selTipopago", $_REQUEST['selTipopago']);
        $this->model->set("txtDetalleventa", $_REQUEST['txtDetalleventa']);
        $this->model->set("usuario", base64_decode($_SESSION['rutUsuario']));
        $this->model->set("idventa", $_REQUEST['idventa']);
        $this->model->set("estado", 1);
        
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

    public function infoVenta(){

        $id = $_REQUEST['idventa'];
        $condicion = '';
        $retorno = "";
        $condicion = 'and a.id_venta= ' .$id.'';
        $this->model->set("condicion", $condicion);

            foreach ($this->model->lista() as $rows) :
            $retorno = '<div class="row card-box">';
            $retorno.='<h5 class="text-custom m-b-5">DETALLE VENTA</h5>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="rut">Valor Venta</label>
                                <p>'.$rows['valor_venta'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Fecha Venta</label>
                                <p>'.$rows['fecha_venta'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Nombre Cliente</label>
                                <p>'.$rows['cliente_venta'].'</p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Dirección Venta</label>
                                <p>'.$rows['direccion_venta'].' </p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Tipo Pago</label>
                                <p>'.$rows['descripcion_tipopago'].'</p>
                        </div>';

            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Detalle</label>
                                <p>'.$rows['descripcion_venta'].'</p>
                        </div>';

            if(base64_decode($_SESSION['tipoUsuario'])==1){
                $retorno .= ' <div class="form-group col-lg-4">
                <label for="nombres">Fecha de Registro (sistema)</label>
                    <p>'.$rows['fechaUsuario_venta'].'</p>
                </div>';
            }
            $retorno .= '</div>';                                
            $retorno .= '</div>';
        
        endforeach;
        echo $retorno;
    }
}
