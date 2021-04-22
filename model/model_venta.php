<?php
require_once "core/conexion.php";

class ventaModel
{

    private $id;
    private $descripcion;
    private $valor;
    //private $direccion;
    private $fechaUsuario; //fecha que indica el usuario que realizo la venta
    private $fecha; // fecha en que se registro en el Sistema
    private $pago;
    private $estado;
    private $usuario;
    private $txtValorventa;
    private $txtFechaventa;
    //private $txtDireccioventa;
    private $selTipopago;
    private $txtDetalleventa;
    private $idventa;

    //variable premium
    private $nombrePremium;
    private $correoPremium;
    private $rutPremium;
    private $dvPremium;

    //variable invitado
    private $nombreInvitado;
    private $correoInvitado;
    private $rutInvitado;
    private $dvInvitado;

    //vaucher verificador
    private $codigoCupon;
    private $codigoVaucher;
    private $urlFile;
    private $idInsert;
    private $extFile;

    private $create;
    private $update;

    private $con;
    private $condicion;

    public function __construct()
    {
        try
        {
            $this->con = new Conexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function set($atributo, $contenido)
    {
        $this->$atributo = $contenido;
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }

    public function lista(){
        try {
            $sql = "SELECT a.id_venta,a.descripcion_venta,a.valor_venta,a.direccion_venta,DATE_FORMAT(a.fechaUsuario_venta,'%d-%m-%Y %H:%i')as fechaUsuario_venta,
                    DATE_FORMAT(a.fechaUsuario_venta,'%Y-%m-%dT%H:%i')as fechaUsuario_venta1, DATE_FORMAT(a.fecha_venta,'%d-%m-%Y %H:%i ')as fecha_venta,a.tipopago_venta,a.estado_venta,a.usuario_venta,
                    b.nombre_usuario ,b.apellido_usuario, c.descripcion_tipopago, a.telefono_venta, a.nombreCliente_venta,a.correoCliente_venta,a.rutCliente_venta,a.dvCliente_venta ,
                    a.nombreInvitado_venta,a.correoInvitado_venta,a.rutInvitado_venta ,a.dvInvitado_venta,a.cupon_venta,a.vaucher_venta
            FROM tb_venta a,tb_usuario b, tb_tipopago c
            WHERE
            a.usuario_venta = b.rut_usuario and a.tipopago_venta = c.id_tipopago
            {$this->get('condicion')} ";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }


    }

    public function count(){
        $sql = "SELECT count(id_venta)as num FROM tb_venta";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countHoy(){
        $hoy = date('Y-m-d');
        $sql = "SELECT count(id_venta)as num FROM tb_venta WHERE fechaUsuario_venta BETWEEN '$hoy 00:00:00' AND '$hoy 23:59:59'";
        //echo $sql;
        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countSiete(){
        $sql = "SELECT count(id_venta)as num FROM tb_venta WHERE YEAR(fechaUsuario_venta) = YEAR(CURRENT_DATE())
        AND MONTH(fechaUsuario_venta)  = MONTH(CURRENT_DATE())";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countMes(){
        $sql = "SELECT count(id_venta)as num FROM tb_venta ";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_venta
                (descripcion_venta,
                  valor_venta,
                  fechaUsuario_venta,
                  fecha_venta,
                  tipoPago_venta,
                  estado_venta,
                  usuario_venta,
                  rutCliente_venta,
                  dvCliente_venta,
                  nombreCliente_venta,
                  correoCliente_venta,
                  rutInvitado_venta,
                  dvInvitado_venta,
                  nombreInvitado_venta,
                  correoInvitado_venta,
                  cupon_venta,
                  vaucher_venta
                  )
                VALUES
                (
                '{$this->get('txtDetalleventa')}',
                '{$this->get('txtValorventa')}',
                '{$this->get('txtFechaventa')}',
                sysdate(),
                '{$this->get('selTipopago')}',
                '{$this->get('estado')}',
                '{$this->get('usuario')}',
                '{$this->get('rutPremium')}',
                '{$this->get('dvPremium')}',
                '{$this->get('nombrePremium')}',
                '{$this->get('correoPremium')}',
                '{$this->get('rutInvitado')}',
                '{$this->get('dvInvitado')}',
                '{$this->get('nombreInvitado')}',
                '{$this->get('correoInvitado')}',
                '{$this->get('codigoCupon')}',
                '{$this->get('codigoVaucher')}'
                )";

        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete(){
        $sql = "UPDATE tb_venta SET estado_venta = '{$this->get('estado')}' WHERE id_venta ='{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
      $fechaActual = date('Y-m-d H:i:s');
        $sql = "UPDATE tb_venta
                SET
                descripcion_venta ='{$this->get('txtDetalleventa')}',
                valor_venta='{$this->get('txtValorventa')}',
                fechaUsuario_venta='{$this->get('txtFechaventa')}',
                fecha_venta = sysdate(),
                tipopago_venta='{$this->get('selTipopago')}',
                estado_venta = '{$this->get('estado')}',
                usuario_venta='{$this->get('usuario')}',
                rutCliente_venta='{$this->get('rutPremium')}',
                dvCliente_venta='{$this->get('dvPremium')}',
                nombreCliente_venta='{$this->get('nombrePremium')}',
                correoCliente_venta='{$this->get('correoPremium')}',
                rutInvitado_venta='{$this->get('rutInvitado')}',
                dvInvitado_venta='{$this->get('dvInvitado')}',
                nombreInvitado_venta='{$this->get('nombreInvitado')}',
                correoInvitado_venta='{$this->get('correoInvitado')}',
                cupon_venta='{$this->get('codigoCupon')}',
                vaucher_venta='{$this->get('codigoVaucher')}'
                WHERE
                id_venta = '{$this->get('id')}'";


        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_venta
                SET estado_venta = '{$this->get('estado')}'
                WHERE id_venta = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

    public function listaPagos(){
        try {
            $sql = "SELECT
                            id_tipopago,
                            descripcion_tipopago
                    FROM
                        tb_tipopago";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function traeUltimoInsert(){
        try {
            $sql = "select last_insert_id() as id";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function addArchivo(){
        $sql = "INSERT INTO tb_archivo
                (ruta_archivo,
                venta_archivo,
                estado_archivo,
                extension_archivo)
                VALUES
                (
                '{$this->get('urlFile')}',
                '{$this->get('idInsert')}',
                '{$this->get('estado')}',
                '{$this->get('extFile')}'
                )";

        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

}
