<?php
require_once "core/conexion.php";

class tipoUsuarioModel
{

    private $id;
    private $descripcion;
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

            $sql = "SELECT id_tipousuario,descripcion_tipousuario,estado_tipousuario
            FROM tb_tipoUsuario
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count(){
        $sql = "SELECT count(id_tipousuario)as num FROM tb_";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_tipoUsuario
                (descripcion_tipoUsuario,estado_tipoUsuario)
                VALUES
                (
                '{$this->get('descripcion')}',
                '{$this->get('estado')}'
                )";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete(){
        $sql = "UPDATE tb_tipoUsuario SET estado_tipoUsuario = '{$this->get('estado')}' WHERE id_tipoUsuario ='{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
        $sql = "UPDATE tb_tipoUsuario
                SET
                descripcion_tipoUsuario = '{$this->get('descripcion')}'
                WHERE
                id_tipoUsuario = '{$this->get('id')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_tipoUsuario
                SET estado_tipoUsuario = '{$this->get('estado')}'
                WHERE id_tipoUsuario = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

}
