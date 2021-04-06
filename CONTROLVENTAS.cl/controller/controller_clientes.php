<?php
session_start();
/*if (isset($_SESSION['nombreUsuario'])) {

} else {
header('Location: index.html');
}*/
date_default_timezone_set('America/Santiago');
require_once 'model/model_clientes.php';
require_once 'model/model_sexo.php';
require_once 'model/model_comuna.php';
require_once 'model/model_tipoprevision.php';
require_once 'model/model_tipopension.php';
//require_once 'model/model_rol.php';

class ClientesController
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
    private $listaxbusq;
    private $infoCliente;

    public function __construct(){

        $this->model      = new ClientesModel();
        $this->modelSexo      = new SexoModel();
        $this->modelComuna     = new ComunaModel();
        $this->modelTipoPrevision = new tipoPrevisionModel();
        $this->modelTipoPension= new tipoPensionModel();
        $this->datetime   = date('Y-m-d H:i:s');
        $this->date       = date('Y-m-d');
        $this->time       = date('H:i:s');
        $this->controller = "clientes";
        $this->seccion    = "Clientes";
        //$this->subseccion = "Maestros";
        $this->lista      = "Clientes";

        //URL ENRUTADOR
        $this->urlhome     = './view.php?c=clientes';
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
        $this->urlchpass   = './view.php?c=' . $this->controller . '&a=cambiapassword';
        $this->listaxbusq      = './view.php?c=' . $this->controller . '&a=listaxbusq';
        $this->listaxfiltro      = './view.php?c=' . $this->controller . '&a=listaxfiltro';
        $this->guardaVisita      = './view.php?c=' . $this->controller . '&a=guardaVisita';
        $this->HistorialVisita      = './view.php?c=' . $this->controller . '&a=HistorialVisita';
        $this->infoCliente      = './view.php?c=' . $this->controller . '&a=infoCliente';
        $this->generaPDF      = './view.php?c=' . $this->controller . '&a=generaPDF&id=';
    }

    public function index(){

        //$condicion = "and c.ind_estado = 1";
        $condicion = '';
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/clientes/table_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function listaxbusq(){

        //$condicion = "and c.ind_estado = 1";
        $condicion = '';
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/clientes/table_' . $this->controller . '2.php';
        require_once './view/maqueta/footer.php';
    }

    public function table(){
        $condicion = '';
        //$condicion = " where c.ind_estado < 3 order by nombre_usuario desc";
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/table_' . $this->controller . '.php';
    }

    public function ultimo(){
        //$condicion = " where estado_usuario < 3 order by rut_usuario desc limit 10";
        $condicion = '';
        $this->model->set("condicion", $condicion);
        require_once './view/' . $this->controller . '/rows_' . $this->controller . '.php';
    }

    public function add(){
        $condicion = "";
        $this->model->set("condicion", $condicion);
        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/add_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function edit(){
        $id = base64_decode($_REQUEST['id']);
        if (isset($id)) {
            $condicion = " where rut_cliente='" . $id . "'";
            $this->model->set("condicion", $condicion);
        }

        require_once './view/maqueta/header.php';
        require_once './view/maqueta/nav.php';
        require_once './view/' . $this->controller . '/edit_' . $this->controller . '.php';
        require_once './view/maqueta/footer.php';
    }

    public function sss(){
        $rut = stripslashes($_REQUEST['rutCliente']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

        $condicion = $rut;
        $this->model->set("condicion", $condicion);
         require_once './view/maqueta/header.php';
         require_once './view/' . $this->controller . '/modal_info_' . $this->controller . '.php';
    }

    public function status(){
        $id        = base64_decode($_REQUEST['id']);
        $condicion = " where estado_usuario in (1,2) and id_usuario='" . $id . "'";
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
    }

    public function save(){
        $rut = stripslashes($_REQUEST['txtRutCliente']);
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
        $this->model->set("nombres", $_REQUEST['txtNombreCliente']);
        $this->model->set("apellidoPaterno", $_REQUEST['txtPaternoCliente']);
        $this->model->set("apellidoMaterno", $_REQUEST['txtMaternoCliente']);
        $this->model->set("direccion", $_REQUEST['txtDireccionCliente']);
        $this->model->set("numCasa", $_REQUEST['txtNumeroCasa']);
        $this->model->set("telefono", $_REQUEST['txtTelCliente']);
        $this->model->set("tipoPrevision", $_REQUEST['detTipoPrevision']);
        $this->model->set("idPrevision", $_REQUEST['tipoPrevision']);
        $this->model->set("tipoPension", $_REQUEST['tipoPension']);
        $this->model->set("fechaAfiliacion", '13-03-2020');
        $this->model->set("fechaNacimiento", $_REQUEST['txtFecNacimiento']);
        $this->model->set("estado", 1);
        $this->model->set("correo", $_REQUEST['txtCorreoElectronico']);
        $this->model->set("hijos", $_REQUEST['hijos']);
        $this->model->set("selectSexo", $_REQUEST['selectSexo']);
        $this->model->set("comuna", $_REQUEST['comuna']);


        if ($query = $this->model->add()) {
            echo "1";
        } else {
            echo "2";
        }
    }

    public function update(){

        $rut = stripslashes($_REQUEST['txtRutCliente']);
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
        $this->model->set("nombres", $_REQUEST['txtNombreCliente']);
        $this->model->set("apellidoPaterno", $_REQUEST['txtPaternoCliente']);
        $this->model->set("apellidoMaterno", $_REQUEST['txtMaternoCliente']);
        $this->model->set("direccion", $_REQUEST['txtDireccionCliente']);
        $this->model->set("numCasa", $_REQUEST['txtNumeroCasa']);
        $this->model->set("telefono", $_REQUEST['txtTelCliente']);
        $this->model->set("tipoPrevision", $_REQUEST['detTipoPrevision']);
        $this->model->set("idPrevision", $_REQUEST['tipoPrevision']);
        $this->model->set("tipoPension", $_REQUEST['tipoPension']);
        $this->model->set("fechaAfiliacion", 'CURDATE()');
        $this->model->set("fechaNacimiento", $_REQUEST['txtFecNacimiento']);
        $this->model->set("estado", 1);
        $this->model->set("correo", $_REQUEST['txtCorreoElectronico']);
        $this->model->set("hijos", $_REQUEST['hijos']);
        $this->model->set("selectSexo" , $_REQUEST['selectSexo']);
        $this->model->set("comuna" , $_REQUEST['comuna']);
        if ($query = $this->model->edit()) {
            echo 1;
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
        $this->model->set("idusu", $id);
        $query = $this->model->cambiaPw();
    }

    public function listaxfiltro(){
        if ($_REQUEST['rut'] != '') {
            $rut = stripslashes($_REQUEST['rut']);
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
        }
        $condicion = '';
        $retorno = "";

        if ($_REQUEST['tipob'] == 1) {
            $condicion = 'and c.direccion_cliente like "%' . $_REQUEST['direccion'] . '%" and numcasa_cliente like "%' . $_REQUEST['direccionnum'] . '%"';
        } else if ($_REQUEST['tipob'] == 2) {
            $condicion = 'and c.rut_cliente = ' . $rut . ' and dv_cliente = "' . $dv . '"';
        } else if ($_REQUEST['tipob'] == 3) {
            $condicion = 'and c.nombres_cliente like "%' . $_REQUEST['nombre'] . '%" and apellidop_cliente like "%' . $_REQUEST['apellidop'] . '%" and apellidom_cliente like "%' . $_REQUEST['apellidom'] . '%"';
        }

        $this->model->set("condicion", $condicion);

        if ($rows = mysqli_fetch_array($this->model->listaClientes())) :
            foreach ($this->model->listaClientes() as $rows) :
                $retorno = '<tr>
        <th data-org-colspan="1" data-columns="tech-companies-1-col-0"><span class="co-name">' . $rows['rut_cliente'] . '-' . $rows['dv_cliente'] . '</span></th>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['nombres_cliente'] . '</td>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['apellidop_cliente'] . '</td>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['apellidom_cliente'] . '</td>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['direccion_cliente'] . '/ N° Casa: ' . $rows['numcasa_cliente'] . '</td>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">' . $rows['telefono_cliente'] . '</td>
        <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5">
         <span class="hint  hint--left iconPerfil" data-hint="Ver Información Cliente" attr-rut="' . $rows['rut_cliente'] . '">
                <a class="btn btn-icon waves-effect waves-light btn-warning">
                    <i style="cursor: pointer;" class="mdi mdi-eye "></i>
                </a>
            </span>
            <span class="hint  hint--left" data-hint="Realizar Visita">
                <button class="btn btn-icon waves-effect waves-light btn-success" onclick="realizarVisita(' . $rows['rut_cliente'] . ')">
                    <i style="cursor: pointer;" class="mdi mdi-fingerprint" id="iconVisita"></i>
                </button>
            </span>
            <span class="hint  hint--left" data-hint="Historial de Visitas">
                <button class="btn btn-icon waves-effect waves-light btn-info" onclick="historilVisitas(' . $rows['rut_cliente'] . ')">
                    <i style="cursor: pointer;" class="mdi mdi-history " id="iconHistorial"></i>
                </button>
            </span>
            <span class="hint  hint--left" data-hint="Generar PDF">
                <a href="'.$this->generaPDF.$rows['rut_cliente'].'" target="_blank">
                <button class="btn btn-icon waves-effect waves-light btn-danger">
                    <i style="cursor: pointer;" class="zmdi zmdi-file-text " id="iconHistorial"></i>
                </button>
                </a>
            </span>
        </td>
    </tr>';
            endforeach;
        else :
            $retorno .= '<tr><th data-org-colspan="1" colspan="7" data-columns="tech-companies-1-col-0"><b>No se encontraron Clientes con estos parametros de busqueda</b></th></tr>';
        endif;

        echo $retorno;
    }

    public function guardaVisita(){

        $this->model->set("txtindivisita", $_REQUEST['txtindivisita']);
        $this->model->set("txtfechavisita", $_REQUEST['txtfechavisita']);
        $this->model->set("rutcli", $_REQUEST['rutcli']);

        if ($query = $this->model->guardaVisita()) {
            echo "1";
        } else {
            echo "2";
        }
    }

    public function HistorialVisita(){

        $rutcli = $_REQUEST['rutcli'];
        $condicion = 'where rutcliente_ficha = '.$rutcli.'';
        $this->model->set("condicion", $condicion);
        $retorno = "";
        $styleicon1 = 'timeline-icon';
        $styleicon2 = 'timeline-icon bg-success';
        $styleicon3 = 'timeline-icon bg-primary';
        $styleicon4 = 'timeline-icon bg-purple';
        $array = array($styleicon1, $styleicon2, $styleicon3, $styleicon4);
        if ($rows = mysqli_fetch_array($this->model->HistorialVisita())) :
                    $retorno .= '<article class="timeline-item timeline-item-left">
                    <div class="text-left">
                        <div class="time-show first">
                            <a href="#" class="btn btn-danger width-lg">Historial Visitas</a>
                        </div>
                    </div>
                </article>';
            foreach ($this->model->HistorialVisita() as $rows) :
                $retorno .= '<article class="timeline-item">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <span class="'.$array[rand(0, count($array) - 1)].'"><i class="zmdi zmdi-check-all"></i></span>
                            <h4 class="">' . $rows['fecha_ficha'] . '</h4>
                            <p class="mb-0">' . $rows['observacion_ficha'] . '</p>
                        </div>
                    </div>
                </div>
            </article>';
            endforeach;
        else :
            $retorno .= 'CLIENTE SIN OBSERVACIONES PREVIAS...';
        endif;

        echo $retorno;
    }

    public function infoCliente(){

        $rut = stripslashes($_REQUEST['rutCliente']);
        $rut = addslashes($rut);
        $rut = trim($rut);
        $rut = htmlspecialchars($rut);
        $rut = str_replace('"', '', $rut);
        $rut = str_replace(':', '', $rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace(',', '', $rut);
        $rut = str_replace(';', '', $rut);

  
            
        $condicion = '';
        $retorno = "";


        $condicion = 'where c.rut_cliente= ' .$rut.'';
        $this->model->set("condicion", $condicion);


            foreach ($this->model->infoClienteCompleta() as $rows) :
            $retorno = '<div class="row card-box">';
            $retorno.='<h5 class="text-custom m-b-5">DATOS PERSONALES</h5>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="rut">Rut Cliente</label>
                                <p>'.$rows['rut_cliente'].'- '.$rows['dv_cliente'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Nombre y Apellido</label>
                                <p>'. strtoupper($rows['nombres_cliente']).' '.strtoupper($rows['apellidop_cliente']).' '.strtoupper($rows['apellidom_cliente']).'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Fecha Nacimiento</label>
                                <p>'.$rows['fechanac_cliente'].'</p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Edad Actual</label>
                                <p>'.$rows['edad_actual'].' <b>AÑO(S)</b> '.$rows['meses_actual'].' <b>MES(ES)</b> '.$rows['dias_actual'].' <b>DÍA(S)</b></p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Sexo</label>
                                <p>'.$rows['descripcion_sexo'].'</p>
                        </div>';

            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Cantidad de Hijos</label>
                                <p>'.$rows['hijos_cliente'].'</p>
                        </div>';
  

            $retorno .= '</div>';

            $retorno .= '<div class="row card-box">';
            $retorno.='<h5 class="text-custom m-b-5">CONTACTOS</h5>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Teléfono</label>
                                <p>'.$rows['telefono_cliente'].'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Calle / N° Casa</label>
                                <p>'.$rows['direccion_cliente'].' / '.$rows['numcasa_cliente'].'</p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Correo</label>
                                <p>'.strtoupper($rows['correo_cliente']).'</p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="comuna">Comuna</label>
                                <p>'.strtoupper($rows['descripcion_comuna']).'</p>
                        </div>'; 

            $retorno .= '</div>';

            $retorno .= '<div class="row card-box">';
            $retorno.='<h5 class="text-custom m-b-5">PENSIONES</h5>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Fondo de Pensión</label>
                                <p>'.strtoupper($rows['descripcion_prevision']).'</p>
                        </div>';
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Detalle del Fondo</label>
                                <p>'.strtoupper($rows['descripcion_tipoprevision']).'</p>
                        </div>'; 
            $retorno .= ' <div class="form-group col-lg-4">
                            <label for="nombres">Tipo de Pensión</label>
                                <p>'.strtoupper($rows['descripcion_tipopension']).'</p>
                        </div>'; 

            $retorno .= '</div>';

            $retorno .= '<div class="row card-box">';
            $retorno.='<h5 class="text-custom m-b-5">BONO POR HIJO</h5>';
            $edad_endias = $rows['edad_dias'];
            

             $edad_endias = $rows['edad_dias'];
             $diasBonoxHijo = 23741.25;
             $diasxcumpliredad = $diasBonoxHijo -$edad_endias;
             $color = '';
            
            if($diasxcumpliredad<=334 && $diasxcumpliredad>1 && $rows['hijos_cliente'] >0 && $rows['id_sexo'] ==2){

                $alert = '<span class="label label-warning">FALTAN: '.intval($diasxcumpliredad).' DÍAS</span>'; 

             }else if($rows['edad_actual'] >= 65 && $rows['hijos_cliente'] >0 && $rows['id_sexo'] ==2){

                $alert = '<span class="label label-success">BONO DISPONIBLE</span>';

             }else{

                    if($diasxcumpliredad<=334 && $diasxcumpliredad>1 ){

                            $alert = '<span class="label label-warning">FALTAN '.intval($diasxcumpliredad).' DÍAS PARA CUMPPLIR 65 AÑOS</span>';

                    }else if($rows['edad_actual'] >= 65){

                            $alert = '<span class="label label-primary">EDAD CUMPLIDA</span>';

                    }else{

                            $alert = '<span class="label label-danger">SIN ALERTAS</span>';

                         }
                                                
                 }
                                               
            $retorno .= '<p color='.$color.'>'.$alert.'</p>';
            $retorno .= '</div>';
        
        endforeach;
        echo $retorno;
    }

    public function generaPDF(){
        $rutcli = $_REQUEST['id'];
        $condicion = '';
        $condicion = 'where rutcliente_ficha = '.$rutcli.'';
        $condicion = 'where c.rut_cliente= ' .$rutcli.'';

        $this->model->set("condicion", $condicion);


        require_once './reportes/reporte1.php';

    }
}
