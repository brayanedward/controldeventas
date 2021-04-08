<?php
require_once "core/conexion.php";

class SexoModel
{

    private $rut;
    private $dv;
    private $nombres;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $fechaNacimiento;
    private $direccion;
    private $numCasa;
    private $telefono;
    private $tipoPrevision;
    private $idPrevision;
    private $tipoPension;
    private $fechaAfiliacion;
    private $estado;
    private $correo;
    private $hijos;
    private $selectSexo;
    
    

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
            s.id_sexo,
            s.descripcion_sexo
    FROM
        tb_sexo s
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}
