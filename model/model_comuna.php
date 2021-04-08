<?php
require_once "core/conexion.php";

class comunaModel
{

    private $descripcion_comuna;
    
    

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

            $sql = "SELECT 
            c.id_comuna,
            c.descripcion_comuna
    FROM
            tb_comuna c
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}