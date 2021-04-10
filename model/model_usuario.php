<?php
require_once "core/conexion.php";

class UsuarioModel
{

    private $rut;
    private $nombre;
    private $apellido;
    private $correo;
    private $estado;
    private $tipo;
    private $password;

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

            $sql = "SELECT rut_usuario,nombre_usuario,apellido_usuario,correo_usuario,estado_usuario,tipo_usuario,password_usuario
            FROM tb_usuario
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count(){
        $sql = "SELECT count(rut_usuario)as num FROM tb_usuario";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_usuario
                (rut_usuario, nombre_usuario, apellido_usuario, correo_usuario, estado_usuario, tipo_usuario, password_usuario)
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
        $sql = "UPDATE tb_usuario SET estado_usuario = '{$this->get('estado')}' WHERE rut_usuario ='{$this->get('rut')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
        $sql = "UPDATE tb_usuario
                SET
                rut_usuario = '{$this->get('rut')}',
                nombre_usuario = '{$this->get('nombre')}',
                apellido_usuario = '{$this->get('apellido')}',
                correo_usuario = '{$this->get('correo')}',
                tipo_usuario = '{$this->get('tipo')}',
                password = '{$this->get('password')}'
                WHERE
                rut_usuario = '{$this->get('idusu')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_usuario
                SET estado_usuario = '{$this->get('estado')}'
                WHERE rut_usuario = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

    public function cambiaPw(){
        $sql = "UPDATE tb_usuario
                SET password_usuario = '{$this->get('pass')}'
                WHERE rut_usuario = '{$this->get('rut_usuario')}'";
        $this->con->consultaSimple($sql);
    }
}
