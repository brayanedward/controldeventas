<?php
require_once "core/conexion.php";

class VentaModel
{

    private $id;
    private $descripcion;
    private $cliente;
    private $valor;
    private $direccion;
    private $fechaUsuario; //fecha que indica el usuario que realizo la venta
    private $fecha; // fecha en que se registro en el Sistema
    private $pago;
    private $estado;
    private $usuario;
    private $txtValorventa;
    private $txtFechaventa;
    private $txtNombrecventa;
    private $txtDireccioventa;
    private $selTipopago;
    private $txtDetalleventa;
    private $idventa;

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

            $sql = "SELECT a.id_venta,a.descripcion_venta,a.cliente_venta,a.valor_venta,a.direccion_venta,a.fechaUsuario_venta,a.fecha_venta,a.tipoPago_venta,a.estado_venta,a.usuario_venta, b.nombre_usuario ,b.apellido_usuario,c.descripcion_tipopago,d.descripcion_tipoUsuario,c.descripcion_tipoPago FROM tb_venta a,tb_usuario b,tb_tipoPago c, tb_tipoUsuario d WHERE a.usuario_venta = b.rut_usuario and a.tipoPago_venta = c.id_tipoPago and b.tipo_usuario = d.id_tipoUsuario
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;


        } catch (Exception $e) {
            die($e->getMessage());
        }

        echo $sql;
    }

    public function count(){
        $sql = "SELECT count(id_venta)as num FROM tb_Venta";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countHoy(){
        $hoy = date('Y-m-d');
        $sql = "SELECT count(id_venta)as num FROM tb_Venta WHERE fechaUsuario_venta BETWEEN '$hoy 00:00:00' AND '$hoy 23:59:59'";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countSiete(){
        $sql = "SELECT count(id_venta)as num FROM tb_Venta WHERE YEAR(fechaUsuario_venta) = YEAR(CURRENT_DATE())
        AND MONTH(fechaUsuario_venta)  = MONTH(CURRENT_DATE())";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countMes(){
        $sql = "SELECT count(id_venta)as num FROM tb_Venta ";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_venta
                (descripcion_venta,cliente_venta,valor_venta,direccion_venta,fechaUsuario_venta,fecha_venta,tipoPago_venta,estado_venta,usuario_venta)
                VALUES
                (
                '{$this->get('txtDetalleventa')}',
                '{$this->get('txtNombrecventa')}',
                '{$this->get('txtValorventa')}',
                '{$this->get('txtDireccioventa')}',
                 sysdate(),
                '{$this->get('txtFechaventa')}',
                '{$this->get('selTipopago')}',
                '{$this->get('estado')}'
                )";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete(){
        $sql = "UPDATE tb_Venta SET estado_Venta = '{$this->get('estado')}' WHERE id_venta ='{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
        $sql = "UPDATE tb_venta
                SET
                descripcion_venta = '{$this->get('txtDetalleventa')}',
                cliente_venta = '{$this->get('txtNombrecventa')}',
                valor_venta = '{$this->get('txtValorventa')}',
                direccion_venta = '{$this->get('txtDireccioventa')}',
                tipoPago_venta = '{$this->get('selTipopago')}',
                fecha_venta = '{$this->get('txtFechaventa')}'
                WHERE
                id_venta = '{$this->get('idventa')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_Venta
                SET estado_Venta = '{$this->get('estado')}'
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

}
