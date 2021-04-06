<?php
require_once "core/conexion.php";

class DashboardModel
{

    private $rut;
    private $dv;
    private $nombre;
    private $apellido;
    private $direccion;
    private $email;
    private $telefono;
    private $password;
    private $rol;
    private $codigo;
    private $estado;
    private $area;

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

            $sql = "SELECT id_usuario, rut_usuario, dv_usuario, nombre_usuario, apellido_usuario, fecha_nacimiento, telefono_usuario, email_usuario, estado_usuario, 
            password_usuario, url_avatar
            FROM tb_usuario
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countUsuario(){
        $sql = "SELECT count(rut_usuario)as num FROM tb_usuario";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countFicha(){
        $sql = "SELECT count(id_ficha)as num FROM tb_ficha";

        $datos = $this->con->consultaRetorno($sql);

        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function countCliente(){
        try{
            $sql = "SELECT count(rut_cliente)as num FROM tb_clientes";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

         }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countVisitas(){
        try{
            $sql = "SELECT count(id_ficha)as num FROM tb_fichas";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

         }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function clientexComunas(){
        try {

            $sql = "SELECT com.descripcion_comuna as descripcion,COUNT(c.rut_cliente) as cantidad FROM tb_comuna com INNER JOIN tb_clientes c on c.id_comuna = com.id_comuna GROUP BY com.id_comuna

                    {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function countMayores(){
        try{
            $sql = "SELECT YEAR( CURDATE( ) ) - YEAR( c.fechanac_cliente ) - IF( MONTH( CURDATE( ) ) < MONTH( c.fechanac_cliente), 1, IF ( MONTH(CURDATE( )) = MONTH( c.fechanac_cliente), IF (DAY( CURDATE( ) ) < DAY( c.fechanac_cliente ),1,0 ),0)) AS edad_actual FROM tb_clientes c";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

         }catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function add(){
        $sql = "INSERT INTO tb_usuario
                (rut_usuario, dv_usuario, nombre_usuario, apellido_usuario, fecha_nacimiento, telefono_usuario, email_usuario, estado_usuario, password_usuario)
                VALUES
                (
                '{$this->get('rut')}',
                '{$this->get('dv')}',
                '{$this->get('nombre')}',
                '{$this->get('apellido')}',
                '{$this->get('fechanac')}',
                '{$this->get('telefono')}',
                '{$this->get('email')}',
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
        $sql = "UPDATE tb_usuario
                SET
                rut_usuario = '{$this->get('rut')}', 
                dv_usuario = '{$this->get('dv')}',
                nombre_usuario = '{$this->get('nombre')}',
                apellido_usuario = '{$this->get('apellido')}',
                fecha_nacimiento = '{$this->get('fechanac')}',
                telefono_usuario = '{$this->get('telefono')}',
                email_usuario = '{$this->get('email')}',
                password_usuario = '{$this->get('password')}'
                WHERE
                id_usuario = '{$this->get('idusu')}'";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function estado(){
        $sql = "UPDATE tb_usuario
                SET estado_usuario = '{$this->get('estado')}'
                WHERE id_usuario = '{$this->get('id')}'";
        $this->con->consultaSimple($sql);
    }

    public function cambiaPw(){
        $sql = "UPDATE tb_usuario
                SET password_usuario = '{$this->get('pass')}'
                WHERE id_usuario = '{$this->get('idusu')}'";
        $this->con->consultaSimple($sql);
    }
}
