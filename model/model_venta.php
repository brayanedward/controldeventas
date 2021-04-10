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

            $sql = "SELECT id_venta,descripcion_venta,cliente_venta,valor_venta,direccion_venta,fechaUsuario_venta,fecha_venta,tipoPago_venta,estado_venta,usuario_venta
            FROM tb_venta
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count(){
        $sql = "SELECT count(id_venta)as num FROM tb_Venta";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_Venta
                (rut_Venta, nombre_Venta, apellido_Venta, correo_Venta, estado_Venta, tipo_Venta, password_Venta)
                VALUES
                (
                '{$this->get('rut')}',
                '{$this->get('nombre')}',
                '{$this->get('apellido')}',
                '{$this->get('correo')}',
                '{$this->get('estado')}',
                '{$this->get('tipo')}',
                '{$this->get('password')}'
                )";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete(){
        $sql = "UPDATE tb_Venta SET estado_Venta = '{$this->get('estado')}' WHERE rut_Venta ='{$this->get('rut')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
        $sql = "UPDATE tb_Venta
                SET
                rut_Venta = '{$this->get('rut')}',
                nombre_Venta = '{$this->get('nombre')}',
                apellido_Venta = '{$this->get('apellido')}',
                correo_Venta = '{$this->get('correo')}',
                tipo_Venta = '{$this->get('tipo')}',
                password = '{$this->get('password')}'
                WHERE
                rut_Venta = '{$this->get('idusu')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_Venta
                SET estado_Venta = '{$this->get('estado')}'
                WHERE rut_Venta = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

    public function cambiaPw(){
        $sql = "UPDATE tb_Venta
                SET password_Venta = '{$this->get('pass')}'
                WHERE rut_Venta = '{$this->get('rut_Venta')}'";
        $this->con->consultaSimple($sql);
    }
}
