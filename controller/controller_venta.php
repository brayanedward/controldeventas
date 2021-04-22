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
        $archivook = 0;
        $rut = stripslashes($_POST['txtRutPremium']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $position = explode("-", $rut);
        $rutPremium      = $position[0];
        $dvPremium      = $position[1];

        if($_POST['txtRutInvitado'] != ''){
            $rut2 = stripslashes($_POST['txtRutInvitado']);
            $rut2 = addslashes($rut2);
            $rut2 = trim($rut2);
            $rut2 = htmlspecialchars($rut2);
            $rut2 = str_replace('"', '', $rut2);
            $rut2 = str_replace(':', '', $rut2);
            $rut2 = str_replace('.', '', $rut2);
            $rut2 = str_replace(',', '', $rut2);
            $rut2 = str_replace(';', '', $rut2);
    
            $position2 = explode("-", $rut2);
            $rutInvitado     = $position2[0];
            $dvInvitado      = $position2[1];
        }else{
            $rutInvitado = '';
            $dvInvitado = '';
        }
        

        foreach ($_FILES["archivo"]['tmp_name'] as $o => $tmp_name) {
            if ($_FILES["archivo"]["name"][$o]) {
                $name = $_FILES["archivo"]["name"][$o];
                $tmp_name = $_FILES["archivo"]["tmp_name"][$o];
                $ext = end(explode(".", $_FILES["archivo"]["name"][$o]));
                $path = 'assets/subidas/';
                $time = time();
                $newpath = $path . $time.$name;
                $pathfinal = $path .$name;

                if (move_uploaded_file($tmp_name, $pathfinal)) {
                    $archivook = 1;
                    rename($path . $name, $newpath);
                } 
            } 
        }

        $this->model->set("txtValorventa", $_POST['txtValorventa']);
        $this->model->set("txtFechaventa", $_POST['txtFechaventa']);
        //$this->model->set("txtDireccioventa", $_REQUEST['txtDireccioventa']);
        $this->model->set("selTipopago", $_POST['selTipopago']);
        $this->model->set("txtDetalleventa", $_POST['txtDetalleventa']);
        //$this->model->set("txtTelefonocliente", $_REQUEST['txtTelefonocliente']);

        $this->model->set("usuario", base64_decode($_SESSION['rutUsuario']));
        $this->model->set("estado", 1);

        //data cliente premium
        $this->model->set("nombrePremium", $_POST['txtNombrePremium']);
        $this->model->set("correoPremium", $_POST['txtCorreoPremium']);
        $this->model->set("rutPremium", $rutPremium);
        $this->model->set("dvPremium", $dvPremium);

        //data cliente invitado (no obligatorio)
        $this->model->set("nombreInvitado", $_POST['txtNombreInvitado']);
        $this->model->set("correoInvitado", $_POST['txtCorreoInvitado']);
        $this->model->set("rutInvitado", $rutInvitado);
        $this->model->set("dvInvitado", $dvInvitado);

        //codigo verificador
        $this->model->set("codigoCupon", $_POST['txtCodigoCupon']);
        $this->model->set("codigoVaucher", $_POST['txtCodigoVaucher']);

        if ($query = $this->model->add()) {
            if($archivook == 1){
                if ($rows1 = mysqli_fetch_array($this->model->traeUltimoInsert())) {
                    $idinsert = $rows1['id'];
                    $this->model->set("urlFile", $newpath);
                    $this->model->set("idInsert", $idinsert);
                    $this->model->set("extFile", $ext);
                    if ($query = $this->model->addArchivo()) {
                        echo '1';
                    }
                }
            }else{
                echo '1';
            }
        } else {
            echo '2';
        }
    }

    public function update(){
        $archivook = 0;
        $rut = stripslashes($_POST['txtRutPremium']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $position = explode("-", $rut);
        $rutPremium      = $position[0];
        $dvPremium      = $position[1];

        if($_POST['txtRutInvitado'] != ''){
            $rut2 = stripslashes($_POST['txtRutInvitado']);
            $rut2 = addslashes($rut2);
            $rut2 = trim($rut2);
            $rut2 = htmlspecialchars($rut2);
            $rut2 = str_replace('"', '', $rut2);
            $rut2 = str_replace(':', '', $rut2);
            $rut2 = str_replace('.', '', $rut2);
            $rut2 = str_replace(',', '', $rut2);
            $rut2 = str_replace(';', '', $rut2);
    
            $position2 = explode("-", $rut2);
            $rutInvitado     = $position2[0];
            $dvInvitado      = $position2[1];
        }else{
            $rutInvitado = '';
            $dvInvitado = '';
        }

        foreach ($_FILES["archivo"]['tmp_name'] as $o => $tmp_name) {
            if ($_FILES["archivo"]["name"][$o]) {
                $name = $_FILES["archivo"]["name"][$o];
                $tmp_name = $_FILES["archivo"]["tmp_name"][$o];
                $ext = end(explode(".", $_FILES["archivo"]["name"][$o]));
                $path = 'assets/subidas/';
                $time = time();
                $newpath = $path . $time.$name;
                $pathfinal = $path .$name;

                if (move_uploaded_file($tmp_name, $pathfinal)) {
                    $archivook = 1;
                    rename($path . $name, $newpath);
                } 
            } 
        }

        $this->model->set("id", $_POST['idventa']);
        $this->model->set("txtValorventa", $_POST['txtValorventa']);
        $this->model->set("txtFechaventa", $_POST['txtFechaventa']);
        //$this->model->set("txtDireccioventa", $_REQUEST['txtDireccioventa']);
        $this->model->set("selTipopago", $_POST['selTipopago']);
        $this->model->set("txtDetalleventa", $_POST['txtDetalleventa']);
        //$this->model->set("txtTelefonocliente", $_REQUEST['txtTelefonocliente']);

        $this->model->set("usuario", base64_decode($_SESSION['rutUsuario']));
        $this->model->set("estado", 1);

        //data cliente premium
        $this->model->set("nombrePremium", $_POST['txtNombrePremium']);
        $this->model->set("correoPremium", $_POST['txtCorreoPremium']);
        $this->model->set("rutPremium", $rutPremium);
        $this->model->set("dvPremium", $dvPremium);

        //data cliente invitado (no obligatorio)
        $this->model->set("nombreInvitado", $_POST['txtNombreInvitado']);
        $this->model->set("correoInvitado", $_POST['txtCorreoInvitado']);
        $this->model->set("rutInvitado", $rutInvitado);
        $this->model->set("dvInvitado", $dvInvitado);

        //codigo verificador
        $this->model->set("codigoCupon", $_POST['txtCodigoCupon']);
        $this->model->set("codigoVaucher", $_POST['txtCodigoVaucher']);

        if ($query = $this->model->edit()) {
            if($archivook == 1){
                $idinsert = $_POST['idventa'];
                $this->model->set("urlFile", $newpath);
                $this->model->set("idInsert", $idinsert);
                $this->model->set("extFile", $ext);
                if ($query = $this->model->addArchivo()) {
                    echo '1';
                }
            }else{
                echo '1';
            }
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
                            <label for="valorVenta">Valor Venta</label>
                                <p>'.$rows['valor_venta'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="fechaVenta">Fecha Venta</label>
                                <p>'.$rows['fecha_venta'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                              <label for="tipoPago">Tipo Pago</label>
                                <p>'.$rows['descripcion_tipopago'].'</p>
                          </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="rutPremium">Rut Cliente Premium</label>
                                <p>'.$rows['rutCliente_venta'].'-'.$rows['dvCliente_venta'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombrePremium">Nombre Cliente Premium</label>
                                <p>'.$rows['nombreCliente_venta'].' </p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                           <label for="correoPremium">Correo Cliente Premium</label>
                           <p>'.$rows['correoCliente_venta'].' </p>
                        </div>';

           if($rows['rutInvitado_venta']){

             $retorno .= ' <div class="form-group col-lg-4">
                                 <label for="rutInvitado">Rut Cliente Invitado</label>
                                 <p>'.$rows['rutInvitado_venta'].'-'.$rows['dvInvitado_venta'].'</p>
                           </div>';
             $retorno .= ' <div class="form-group col-lg-4">
                                 <label for="nombreInvitado">Nombre Cliente Invitado</label>
                                 <p>'.$rows['nombreInvitado_venta'].' </p>
                           </div>';
             $retorno .= ' <div class="form-group col-lg-4">
                                 <label for="correoInvitado">Correo Cliente Correo</label>
                                 <p>'.$rows['correoInvitado_venta'].' </p>
                           </div> ';
           }

           if($rows['cupon_venta']){
             $retorno .= ' <div class="form-group col-lg-4">
                                 <label for="cupon">Código Cupón</label>
                                 <p>'.$rows['cupon_venta'].'</p>
                           </div>';
           }
           if($rows['vaucher_venta']){
             $retorno .= ' <div class="form-group col-lg-4">
                                 <label for="vaucher">Código Váucher (Transacción)</label>
                                 <p>'.$rows['vaucher_venta'].' </p>
                           </div>';
           }



            if(base64_decode($_SESSION['tipoUsuario'])==1){
                $retorno .= ' <div class="form-group col-lg-4">
                <label for="nombres">Fecha de Registro (Sistema)</label>
                    <p>'.$rows['fechaUsuario_venta'].'</p>
                </div>';
            }

            $retorno .= ' <div class="form-group col-lg-12">
                            <label for="nombres">Detalle</label>
                                <p>'.$rows['descripcion_venta'].'</p>
                        </div>';
            $retorno .= '</div>';
            $retorno .= '</div>';

            foreach ($this->model->listaArchivos($id) as $rows2) :
                $retorno .= '<div class="row card-box">';
                $retorno .= '<b>Archivos Adjuntados</b><br>';
                if($rows2['extension_archivo'] == 'png' || $rows2['extension_archivo'] == 'jpg' || $rows2['extension_archivo'] == 'jpeg'){
                    $retorno .= '<img onclick="openimg(\''.$rows2['ruta_archivo'].'\')" style="width: 10%;margin-left: 1%;margin-top: 1%;cursor:pointer;" src="'.$rows2['ruta_archivo'].'">';
                }else if($rows2['extension_archivo'] == 'pdf'){
                    $retorno .= '<img onclick="openpdf(\''.$rows2['ruta_archivo'].'\')" style="width: 4%;margin-left: 1%;margin-top: 1%;cursor:pointer;" src="assets/images/pdf-icon.png">';
                }else{
                    $retorno .= '<a href="'.$rows2['ruta_archivo'].'" ><img style="width: 4%;margin-left: 1%;margin-top: 1%;cursor:pointer;" src="assets/images/archivo.png">';
                }
                $retorno .= '</div>';
            endforeach;


            $retorno .= '<div class="row card-box">';
            $retorno .= '<b>Fecha Venta:</b> Indicada por el vendedor como la fecha real en que realizo la venta<br><b>Fecha Venta (sistema):</b> Fecha en la que se realizo el registro.';
            $retorno .= '</div>';

        endforeach;
        echo $retorno;
    }

    public function subirArchivos()
 {

     $files = '';
     $return= '';
     $idVenta = $_GET["idVenta"];
     $time = md5(rand(20, 1000) . time());
     $name = $idsolicitud;
     //comprobamos que sea una petición ajax
     if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

         // si hay algun archivo que subir
         if ($_FILES["archivo"]["name"])  {

             $ruta = "/var/www/html/assets/ssan_bo_recepciondedespachos/files/$name/";
             if (!is_dir($ruta)) {
                 mkdir($ruta, 0777);
             }

             for ($i = 0; $i < count($_FILES["archivo"]["name"]); $i++) {

                 //obtenemos el archivo a subir
                 //$file = time() . '_' . $_FILES["archivo"]["name"][$i];
                 //$file = str_replace(' ', '', $file);
                 $file = $idVenta . '_' .$i. '_' . $_FILES["archivo"]["name"][$i];
                 $file = str_replace(' ', '', $file);
                 //comprobamos si existe un directorio para subir el archivo
                 //si no es así, lo creamos
                 if (!is_dir($ruta)) {
                     mkdir($ruta, 0777);
                 }
                  //comprobamos si el archivo ha subido
                  if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i], $ruta . '/' . $file)) {
                     sleep(3); //retrasamos la petición 3 segundos
                     $files = $file;
                     if ($i == 0) {
                         $url = $ruta . '/' .$file;
                     } else if ($i == 1) {
                         $url = $ruta . '/' .$file;
                     }
                 }
             }

         } else {
             echo 'No detecta File ';
         }

     } else {
         $return = false;
     }

      //Confirma subida de archivos
      if (!empty($files)) {
         $return = true;
     }

     $html = '';
     if ($return) {
         $html = "<script>jAlert('Recepción realizada con documentos adjuntados');</script>";

     }

     echo $html;

 }
}
