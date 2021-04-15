<?php
require_once "core/conexion.php";

class reporteModel
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




}
