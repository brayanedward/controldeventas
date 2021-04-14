<?php
  $bd_host = "localhost"; 
  $bd_usuario = "desaijju_test"; 
  $bd_password = "@gA^u,]5iko_"; 
  $bd_base = "desaijju_test"; 
 
$con = new mysqli('127.0.0.1', $bd_usuario, $bd_password, $bd_base);
if ($con->connect_error) {
	echo("Falla conexi贸n: \n");   
    exit();
} 

$brigada = $_GET['brigada'];

if($brigada != ''){
	$sql="SELECT * FROM incendios where codbrigada=".$brigada;
}else{
	$sql="SELECT * FROM incendios";
}

$result = $con->query($sql);
$datos=array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	   $datos[]=$row;
	}
 }   
else {
    echo "0 results";
}
$con->close();
echo json_encode($datos);
