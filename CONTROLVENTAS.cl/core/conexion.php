<?php
class Conexion
{
    private $datos = array(
        "host" => "localhost",
        "user" => "desaijju_nemer",
        "pass" => "74t#kK~XFCbd",
        "db"   => "desaijju_nemer",
        //"host" => "localhost",
        //"user" => "root",
        //"pass" => "",
        //"db"   => "sistema",
    );
    public $con;

    public function __construct()
    {
        $this->con = new \mysqli($this->datos['host'],
            $this->datos['user'], $this->datos['pass'],
            $this->datos['db']);
    }

    public function consultaSimple($sql)
    {
        $this->con->set_charset("utf8");
        $this->con->query($sql);

    }
    public function consultaRetorno($sql)
    {
        $this->con->set_charset("utf8");
        $datos = $this->con->query($sql);
        return $datos;

    }

    public function cleanString($string)
    {

        $string = trim($string);
        $string = mysql_escape_string($string);
        $string = htmlspecialchars($string);

        return $string;

    }

    public function mysqli_insert_id(){
        return mysqli_insert_id($this->con);
    }


    public function puntos($s)
    {

        $s = str_replace('"', '', $s);
        $s = str_replace(':', '', $s);
        $s = str_replace('.', '', $s);
        $s = str_replace(',', '', $s);
        $s = str_replace(';', '', $s);

        return $s;

    }

    public function limpiar($string)
    {
        $string = stripslashes($string);
        $string = addslashes($string);

        return $string;
    }
}
