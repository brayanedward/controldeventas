<?php
require_once "core/conexion.php";

class archivoModel
{

    private $id;
    private $ruta;
    private $venta;
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

            $sql = "SELECT id_archivo,ruta_archivo,venta_archivo,estado_archivo
            FROM tb_archivo
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count(){
        $sql = "SELECT count(id_archivo)as num FROM tb_archivo";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_archivo
                (ruta_archivo,venta_archivo,estado_archivo)
                VALUES
                (
                '{$this->get('ruta')}',
                '{$this->get('venta')}',
                '{$this->get('estado')}'
                )";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function delete(){
        $sql = "UPDATE tb_archivo SET estado_archivo = '{$this->get('estado')}' WHERE id_archivo ='{$this->get('id')}'";
        //echo $sql;
        $this->con->consultaSimple($sql);
    }

    public function edit(){
        $sql = "UPDATE tb_archivo
                SET
                ruta_archivo = '{$this->get('ruta')}',
                venta_archivo = '{$this->get('venta')}'
                WHERE
                id_archivo = '{$this->get('id')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_archivo
                SET estado_archivo = '{$this->get('estado')}'
                WHERE id_archivo = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

}
