<?php
require_once "core/conexion.php";

class tipoPrevisionModel
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

    public function lista($condicion){
        try {

            $sql = "SELECT 
            tp.id_tipoprevision,
            tp.descripcion_tipoprevision,
            tp.id_prevision_tipoprevision
    FROM
            tb_tipoprevision tp
    WHERE 
            tp.id_prevision_tipoprevision = ".$condicion."
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}