<?php
  $bd_host = "localhost"; 
  $bd_usuario = "desaijju_test"; 
  $bd_password = "@gA^u,]5iko_"; 
  $bd_base = "desaijju_test"; 
 
$con = new mysqli('127.0.0.1', $bd_usuario, $bd_password, $bd_base);
if ($con->connect_error) {
	echo("Falla conexión: \n");   
    exit();
} 
if($_GET['rutj'] != ''){
  $rutj=$_GET['rutj'];
  $codbri=$_GET['codbri'];
  $horaini=$_GET['horaini'];
  $horaterm=$_GET['horaterm'];
  $nomb_comuna=$_GET['nomb_comuna'];
  $fecini = date("Y-m-d", strtotime($_GET['fecini']));
  $fecterm = date("Y-m-d", strtotime($_GET['fecterm']));
  $comentario=$_GET['comentario'];

  $sql="INSERT INTO incendios (rutjbrigada, codbrigada, fec_inicio, fec_termino, hora_inicio, hora_termino, nomb_comuna, comentario) 
  VALUES ('$rutj', '$codbri', '$fecini', '$fecterm', '$horaini', '$horaterm', '$nomb_comuna', '$comentario')";
  $con->query($sql) or die('Error. '.mysql_error());
}else{
  $sql="SELECT * FROM incendios";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    echo '<style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>';
    echo '<table>';
    echo '
    <tr>
      <td>Rut Brigadistas</td>
      <td>Codigo Brigada</td>
      <td>Fecha Inicio Incendio</td>
      <td>Hora Inicio Incendio</td>
      <td>Fecha Termino Incendio</td>
      <td>Hora Termino Incendio</td>
      <td>Comuna Incendio</td>
    </tr>';
      while($row = $result->fetch_assoc()) {
        echo '
            <tr>
              <td> '.$row["rutjbrigada"].'</td>
              <td> '.$row["codbrigada"].'</td>
              <td> '.$row["fec_inicio"].'</td>
              <td> '.$row["hora_inicio"].'</td>
              <td> '.$row["fec_termino"].'</td>
              <td> '.$row["hora_termino"].'</td>
              <td> '.$row["nomb_comuna"].'</td>
              <td> '.$row["comentario"].'</td>
            </tr>';
    }
    echo '</table>';
   }   
  else {
      echo "0 results";
  }
  $con->close();

}

?>
