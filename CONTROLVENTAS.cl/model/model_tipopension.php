<?php
require_once "core/conexion.php";

class tipoPensionModel
{

    private $descripcion;
    
    

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
            c.id_tipopension,
            c.descripcion_tipopension
    FROM
            tb_tipopension c
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}