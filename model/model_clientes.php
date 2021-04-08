<?php
require_once "core/conexion.php";

class ClientesModel
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
                            c.rut_cliente,
                            c.dv_cliente,
                            c.nombres_cliente,
                            c.apellidop_cliente,
                            c.apellidom_cliente,
                            c.fechanac_cliente,
                            c.direccion_cliente,
                            c.numcasa_cliente,
                            c.telefono_cliente,
                            c.ind_estado,
                            c.tipoprev_cliente,
                            c.idprev_cliente,
                            c.tipopension_cliente,
                            c.fechaafiliacion_cliente,
                            tp.descripcion_tipopension,
                            c.correo_cliente,
                            c.hijos_cliente,
                            c.id_sexo,
                            DATEDIFF(now(),c.fechanac_cliente) edad_dias,
                            YEAR( CURDATE( ) ) - YEAR( c.fechanac_cliente ) - IF( MONTH( CURDATE( ) ) < MONTH( c.fechanac_cliente), 1, IF ( MONTH(CURDATE( )) = MONTH( c.fechanac_cliente), IF (DAY( CURDATE( ) ) < DAY( c.fechanac_cliente ),1,0 ),0)) AS edad_actual, 
                            MONTH(CURDATE()) - MONTH( c.fechanac_cliente) + 12 * IF( MONTH(CURDATE())<MONTH( c.fechanac_cliente), 1,IF(MONTH(CURDATE())=MONTH( c.fechanac_cliente),IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0),0) ) - IF(MONTH(CURDATE())<>MONTH( c.fechanac_cliente),(DAY(CURDATE())<DAY( c.fechanac_cliente)), IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0 ) ) AS meses_actual, 
                            ( DAY( CURDATE( ) ) - DAY( c.fechanac_cliente ) +30 * ( DAY(CURDATE( )) < DAY( c.fechanac_cliente) )) AS dias_actual 
                    FROM
                        tb_clientes c
                    INNER JOIN 
                        tb_tipopension tp on tp.id_tipopension = c.tipopension_cliente
                    ORDER BY 
                        edad_actual DESC

                         
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function infoClienteCompleta(){
        try {

            $sql = "SELECT 
                            c.rut_cliente,
                            c.dv_cliente,
                            c.nombres_cliente,
                            c.apellidop_cliente,
                            c.apellidom_cliente,
                            DATE_FORMAT(c.fechanac_cliente, '%d-%m-%Y') as fechanac_cliente,
                            c.fechanac_cliente as fechanac_cliente2,
                            c.direccion_cliente,
                            c.numcasa_cliente,
                            c.telefono_cliente,
                            c.ind_estado,
                            c.tipoprev_cliente,
                            c.idprev_cliente,
                            c.tipopension_cliente,
                            c.fechaafiliacion_cliente,
                            tp.descripcion_tipopension,
                            c.correo_cliente,
                            c.hijos_cliente,
                            c.id_sexo,
                            DATEDIFF(now(),c.fechanac_cliente) edad_dias,
                            YEAR( CURDATE( ) ) - YEAR( c.fechanac_cliente ) - IF( MONTH( CURDATE( ) ) < MONTH( c.fechanac_cliente), 1, IF ( MONTH(CURDATE( )) = MONTH( c.fechanac_cliente), IF (DAY( CURDATE( ) ) < DAY( c.fechanac_cliente ),1,0 ),0)) AS edad_actual, 
                            MONTH(CURDATE()) - MONTH( c.fechanac_cliente) + 12 * IF( MONTH(CURDATE())<MONTH( c.fechanac_cliente), 1,IF(MONTH(CURDATE())=MONTH( c.fechanac_cliente),IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0),0) ) - IF(MONTH(CURDATE())<>MONTH( c.fechanac_cliente),(DAY(CURDATE())<DAY( c.fechanac_cliente)), IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0 ) ) AS meses_actual, 
                            ( DAY( CURDATE( ) ) - DAY( c.fechanac_cliente ) +30 * ( DAY(CURDATE( )) < DAY( c.fechanac_cliente) )) AS dias_actual,
                            tpre.descripcion_tipoprevision,
                            tprevi.descripcion_prevision,
                            sex.descripcion_sexo,
                            com.descripcion_comuna,
                            com.id_comuna,
                            tp.id_tipopension
                    FROM
                        tb_clientes c
                    INNER JOIN 
                        tb_tipopension tp on tp.id_tipopension = c.tipopension_cliente
                    INNER JOIN 
                        tb_tipoprevision tpre on tpre.id_tipoprevision = c.tipoprev_cliente
                    INNER JOIN 
                        tb_sexo sex on sex.id_sexo = c.id_sexo
                    INNER JOIN 
                        tb_prevision tprevi on tprevi.id_prevision = c.idprev_cliente
                    INNER JOIN 
                        tb_comuna com on com.id_comuna = c.id_comuna
                    {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    
    public function listaPensiones(){
        try {

            $sql = "SELECT 
                            p.id_tipopension,
                            p.descripcion_tipopension
                    FROM
                        tb_tipopension p
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaComunas(){
        try {

            $sql = "SELECT 
                            p.id_comuna,
                            p.descripcion_comuna
                    FROM
                        tb_comuna p
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaSexo(){
        try {

            $sql = "SELECT 
                            p.id_sexo,
                            p.descripcion_sexo
                    FROM
                        tb_sexo p
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaTipoPrevision($condicion){
        try {

            $sql = "SELECT 
                            p.id_tipoprevision,
                            p.descripcion_tipoprevision,
                            p.id_prevision_tipoprevision,
                            p.estado_tipoprevision
                    FROM
                            tb_tipoprevision p
                    WHERE 
                            p.id_prevision_tipoprevision = ".$condicion."

            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);

            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function TraeIdProfesional($rut){
        try{
            $sql = "SELECT id_profesional FROM tb_profesionales where rut_profesional = '$rut'";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function count(){
        $sql = "SELECT count(rut_usuario)as num FROM tb_usuario";

        $datos = $this->con->consultaRetorno($sql);
        if ($rows = mysqli_fetch_array($datos)) {
            $num = $rows[0];
        }
        return $num;
    }

    public function add(){
        $sql = "INSERT INTO tb_clientes
                (   rut_cliente, 
                    dv_cliente, 
                    nombres_cliente, 
                    apellidop_cliente, 
                    apellidom_cliente, 
                    fechanac_cliente, 
                    direccion_cliente, 
                    numcasa_cliente, 
                    telefono_cliente,
                    tipoprev_cliente,
                    idprev_cliente,
                    tipopension_cliente,
                    fechaafiliacion_cliente,
                    ind_estado,
                    correo_cliente,
                    hijos_cliente,
                    id_sexo,
                    id_comuna)
                VALUES
                (
                '{$this->get('rut')}',
                '{$this->get('dv')}',
                '{$this->get('nombres')}',
                '{$this->get('apellidoPaterno')}',
                '{$this->get('apellidoMaterno')}',
                '{$this->get('fechaNacimiento')}',
                '{$this->get('direccion')}',
                '{$this->get('numCasa')}',
                '{$this->get('telefono')}',
                '{$this->get('tipoPrevision')}',
                '{$this->get('idPrevision')}',
                '{$this->get('tipoPension')}',
                '{$this->get('fechaAfiliacion')}',
                '{$this->get('estado')}',
                '{$this->get('correo')}',
                '{$this->get('hijos')}',
                '{$this->get('selectSexo')}',
                '{$this->get('comuna')}'
            
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
        $sql = "UPDATE tb_clientes
                SET
                nombres_cliente = '{$this->get('nombres')}', 
                apellidop_cliente = '{$this->get('apellidoPaterno')}',
                apellidom_cliente = '{$this->get('apellidoMaterno')}',
                fechanac_cliente = '{$this->get('fechaNacimiento')}',
                direccion_cliente = '{$this->get('direccion')}',
                numcasa_cliente = '{$this->get('numCasa')}',
                telefono_cliente = '{$this->get('telefono')}',
                tipoprev_cliente = '{$this->get('tipoPrevision')}',
                idprev_cliente = '{$this->get('idPrevision')}',
                tipopension_cliente = '{$this->get('tipoPension')}',
                fechaafiliacion_cliente = '{$this->get('fechaAfiliacion')}',
                ind_estado = '{$this->get('estado')}',
                correo_cliente = '{$this->get('correo')}',
                hijos_cliente = '{$this->get('hijos')}',
                id_sexo = '{$this->get('selectSexo')}',
                id_comuna = '{$this->get('comuna')}'
                WHERE
                rut_cliente = '{$this->get('rut')}'";
   
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

    public function listaClientes(){
        try {

            $sql = "SELECT 
            c.rut_cliente,
            c.dv_cliente,
            c.nombres_cliente,
            c.apellidop_cliente,
            c.apellidom_cliente,
            c.fechanac_cliente,
            c.direccion_cliente,
            c.numcasa_cliente,
            c.telefono_cliente,
            c.ind_estado,
            c.tipoprev_cliente,
            c.idprev_cliente,
            c.tipopension_cliente,
            c.fechaafiliacion_cliente,
            tp.descripcion_tipopension,
            c.correo_cliente
    FROM
        tb_clientes c
    INNER JOIN 
        tb_tipopension tp on tp.id_tipopension = c.tipopension_cliente
            {$this->get('condicion')}";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function guardaVisita(){
        $sql = "INSERT INTO tb_fichas
                (   rutcliente_ficha, 
                    observacion_ficha, 
                    fecha_ficha)
                VALUES
                ('{$this->get('rutcli')}',
                '{$this->get('txtindivisita')}',
                '{$this->get('txtfechavisita')}')";
        $datos = $this->con->consultaRetorno($sql);
        return $datos;
    }

    public function HistorialVisita(){
        try {
            $sql = "SELECT id_ficha, observacion_ficha, DATE_FORMAT(fecha_ficha, '%d-%m-%Y') as fecha_ficha from tb_fichas
            {$this->get('condicion')} order by fecha_ficha DESC";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function HistorialVisitarut($rut){
        try {
            $sql = "SELECT id_ficha, observacion_ficha, DATE_FORMAT(fecha_ficha, '%d-%m-%Y') as fecha_ficha from tb_fichas
            where rutcliente_ficha = $rut order by id_ficha asc limit 1";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function infoClienteCompletarut($rut){
        try {

            $sql = "SELECT 
                            c.rut_cliente,
                            c.dv_cliente,
                            c.nombres_cliente,
                            c.apellidop_cliente,
                            c.apellidom_cliente,
                            DATE_FORMAT(c.fechanac_cliente, '%d-%m-%Y') as fechanac_cliente,
                            c.direccion_cliente,
                            c.numcasa_cliente,
                            c.telefono_cliente,
                            c.ind_estado,
                            c.tipoprev_cliente,
                            c.idprev_cliente,
                            c.tipopension_cliente,
                            c.fechaafiliacion_cliente,
                            tp.descripcion_tipopension,
                            c.correo_cliente,
                            c.hijos_cliente,
                            c.id_sexo,
                            DATEDIFF(now(),c.fechanac_cliente) edad_dias,
                            YEAR( CURDATE( ) ) - YEAR( c.fechanac_cliente ) - IF( MONTH( CURDATE( ) ) < MONTH( c.fechanac_cliente), 1, IF ( MONTH(CURDATE( )) = MONTH( c.fechanac_cliente), IF (DAY( CURDATE( ) ) < DAY( c.fechanac_cliente ),1,0 ),0)) AS edad_actual, 
                            MONTH(CURDATE()) - MONTH( c.fechanac_cliente) + 12 * IF( MONTH(CURDATE())<MONTH( c.fechanac_cliente), 1,IF(MONTH(CURDATE())=MONTH( c.fechanac_cliente),IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0),0) ) - IF(MONTH(CURDATE())<>MONTH( c.fechanac_cliente),(DAY(CURDATE())<DAY( c.fechanac_cliente)), IF (DAY(CURDATE())<DAY( c.fechanac_cliente),1,0 ) ) AS meses_actual, 
                            ( DAY( CURDATE( ) ) - DAY( c.fechanac_cliente ) +30 * ( DAY(CURDATE( )) < DAY( c.fechanac_cliente) )) AS dias_actual,
                            tpre.descripcion_tipoprevision,
                            tprevi.descripcion_prevision,
                            sex.descripcion_sexo,
                            com.descripcion_comuna
                    FROM
                        tb_clientes c
                    INNER JOIN 
                        tb_tipopension tp on tp.id_tipopension = c.tipopension_cliente
                    INNER JOIN 
                        tb_tipoprevision tpre on tpre.id_tipoprevision = c.tipoprev_cliente
                    INNER JOIN 
                        tb_sexo sex on sex.id_sexo = c.id_sexo
                    INNER JOIN 
                        tb_prevision tprevi on tprevi.id_prevision = c.idprev_cliente
                    INNER JOIN 
                        tb_comuna com on com.id_comuna = c.id_comuna
                        where c.rut_cliente= $rut";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
