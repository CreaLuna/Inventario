<?php 
require '../../includes/_db.php';
$buscar=$_POST['buscar'];
$SQL_READ="SELECT * FROM productos Where nombre LIKE '%".$buscar."%'";

$sql_query=mysqli_query($conexion,$SQL_READ);
?>
