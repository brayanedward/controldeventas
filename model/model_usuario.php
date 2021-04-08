<?php
require_once "core/conexion.php";

class UsuarioModel
{

    private $rut;
    private $dv;
    private $nombre;
    private $apellido;
    private $direccion;
    private $password;
    private $estado;

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

            $sql = "SELECT rut_usuario, dv_usuario, nombres_usuario, apellidoPaterno_usuario, apellidoMaterno_usuario, password_usuario, estado_usuario
            FROM tb_usuarios
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
        $sql = "INSERT INTO tb_usuarios
                (rut_usuario, dv_usuario, nombres_usuario, apellidoPaterno_usuario, apellidoMaterno_usuario, estado_usuario, password_usuario)
                VALUES
                (
                '{$this->get('rut')}',
                '{$this->get('dv')}',
                '{$this->get('nombre')}',
                '{$this->get('apellidop')}',
                '{$this->get('apellidom')}',
                '{$this->get('estado')}',
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
        $sql = "UPDATE tb_usuarios
                SET
                rut_usuario = '{$this->get('rut')}', 
                dv_usuario = '{$this->get('dv')}',
                nombres_usuario = '{$this->get('nombre')}',
                apellidoPaterno_usuario = '{$this->get('apellidop')}',
                apellidoMaterno_usuario = '{$this->get('apellidom')}',
                password_usuario = '{$this->get('password')}'
                WHERE
                rut_usuario = '{$this->get('idusu')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_usuarios
                SET estado_usuario = '{$this->get('estado')}'
                WHERE rut_usuario = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

    public function cambiaPw(){
        $sql = "UPDATE tb_usuarios
                SET password_usuario = '{$this->get('pass')}'
                WHERE rut_usuario = '{$this->get('rut_usuario')}'";
        $this->con->consultaSimple($sql);
    }
}
