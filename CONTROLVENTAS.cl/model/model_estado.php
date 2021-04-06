<?php
require_once "core/conexion.php";

class EstadoModel
{

    private $id;
    private $descripcion;
    private $modulo;
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

    public function lista()
    {
        try {

            $sql = "SELECT id_estado, descripcion_estado
            FROM tb_estado {$this->get('condicion')} ";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count()
    {
        $sql = "SELECT count(id_estado)as num FROM tb_estado {$this->get('condicion')} ";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add()
    {
        $sql = "
                INSERT INTO tb_estado
                (descripcion_estado, estado_estado)
                VALUES
                (
                '{$this->get('descripcion')}',
                '{$this->get('estado')}'
                )";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete()
    {
        $sql = "UPDATE tb_estado SET estado_estado = '{$this->get('estado')}' WHERE id_estado ='{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit()
    {
        $sql = "
                UPDATE tb_estado
                SET
                descripcion_estado = '{$this->get('descripcion')}'
                WHERE
                id_estado = '{$this->get('id')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado()
    {
        $sql = "
                UPDATE tb_estado
                SET estado_estado = '{$this->get('estado')}'
                WHERE id_estado = '{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }
}
