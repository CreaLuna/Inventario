<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Clientes</h1></center>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<a href="agregar_cliente.php"><input  class="btn btn-primary" type="button" value="Agregar cliente"></a>
<div class="row">
    <div class="col-sm-12">
   <!-- CONTROL PARA BUSCAR EN LA TABLA CLIENTES -->

<h4>Buscador</h4>

<form action="" method="POST">
<input type="text" name="buscar">
<input type="submit"  value="Buscar">
</form>
<!-- -------------- -->
    </div>
</div>


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Codigo cliente</th>
<th>Nombre cliente</th>
<th>Region cliente</th>
<th>Numero telefono</th>
<th>Correo</th>
<th>Usuario</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php

$sql = "SELECT * FROM clientes";
$clientes = mysqli_query($conexion, $sql);
if($clientes -> num_rows > 0){
foreach($clientes as $key => $row ){
?>
<!-- empieza la tabla-->
<tr>
<td <?php echo  'class="'.$row['id'] .'"'; ?>><?php echo $row['Codigo_client']; ?></td>
<td><?php echo $row['Nombre_clien']; ?></td>
<td><?php echo $row['Region']; ?></td>
<td><?php echo $row['Numero']; ?></td>
<td><?php echo $row['correo']; ?></td>
<td><?php echo $row['usuario']; ?></td>

<td style="color:#000000; font-weight: bold; background-color: 
    <?php 
        if ($row['estado'] == 0) {
            echo '#FFD1D1';
        } else {
            echo '#84DFA7';
        }
    ?>
">
    <?php 
        if ($row['estado'] == 0) {
            echo "Inactivo";
        } else {
            echo "Activo";
        }
    ?>
   </td>

<td>
  <a href="editar_cliente.php?id=<?php echo $row['Codigo_client']?>"class="btn btn-primary" border-radius: 2px>Editar Datos</a>
  </a>
  <br>
  <br>
  <a href="des_cliente.php?id=<?php echo $row['Codigo_client']?>" class="btn btn-danger" border-radius: 2px>Desactivar Cliente</a>
  </a>
  <br>
  <br>
  <a href="activar_cliente.php?id=<?php echo $row['Codigo_client']?>" class="btn btn-success" border-radius: 2px>Activar Cliente</a>
  </a>
</td>
</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="4">No existe registros</td>
    </tr>

    <?php
}?>
</tbody>

</table>



</body>

</html>