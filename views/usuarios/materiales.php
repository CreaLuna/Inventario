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
<center><h1>Materiales</h1></center>
<a href="agregar_material.php"><input  class="btn btn-primary" type="button" value="Agregar Material"></a>
<div class="row">
    <div class="col-sm-12">
    <!-- CONTROL PARA BUSCAR EN LA TABLA MATERIALES -->

<h4>Buscador</h4>

<form action="" method="POST">
<input type="text" name="buscar">
<input type="submit"  value="Buscar">
</form>
<!-- -------------- -->
    </div>
</div>

<?php
//Mostramos la sesion
session_start();
//Nos mostrara el mensaje enviado de la funcion
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<table class="table table-striped table-hover">
<thead>

<tr>

<th>CODIGO</th>
<th>NOMBRE</th>
<th>CANTIDAD</th>
<th>PRECIO</th>
<th>CATEGORIA</th>
<th>PROVEEDOR</th>
<th>IMAGEN</th>  
<th>Acciones</th> 
</tr>

</thead>

<tbody>
<?php
$imagenNull = "../../img/no_disponible.png";
$sql = "SELECT materiales.Codigo_material,materiales.Imagen,materiales.Nombre_mate,materiales.Cantidad,materiales.Precio,
 materiales.Codigo_catego,materiales.Codigo_provee,proveedores.Nombre_prove, categoria.Nombre_cate FROM materiales INNER JOIN proveedores ON materiales.Codigo_provee= proveedores.Codigo_provee
 INNER JOIN categoria ON materiales.Codigo_catego=categoria.Codigo_catego";
$materiales = mysqli_query($conexion, $sql);
if($materiales -> num_rows > 0){
foreach($materiales as $key => $row ){
?>
<!-- empieza la tabla-->

<tr>

<td <?php echo  'class="'.$row['id'] .'"'; ?>><?php echo $row['Codigo_material']; ?></td>

<td><?php echo $row['Nombre_mate']; ?></td>

<td style=" color:#000000;
font-weight: bold;
background-color: 
                <?php 
                    if ($row['Cantidad'] < 50) {
                        echo 'red';
                        
                    } elseif ($row['Cantidad'] == 50) {
                        echo 'yellow';
                    
                    } else {
                        echo 'green';
                        
                    }
                ?>">
                    <?php echo $row['Cantidad']; ?>
                </td>
<td><?php echo $row['Precio']; ?></td>
<td><?php echo $row['Nombre_cate']; ?></td>
<td><?php echo $row['Nombre_prove']; ?></td>
<?php 
if (empty($row['Imagen'])) {
    // Si no hay imagen en la base de datos, muestra la imagen por defecto
    echo '<td><img width="100" src="' . $imagenNull . '"></td>';
} else {
    // Si hay imagen en la base de datos, muestra esa imagen
    echo '<td><img width="100" src="data:image;base64,' . base64_encode($row['Imagen']) . '"></td>';
}
?>
	
<td>
  <a href="editar_material.php?id=<?php echo $row['Codigo_material']?>">
    <div">
      Editar
    </div>
  </a>
  <a>|</a>
  <a href="eliminar_material.php?id=<?php echo $row['Codigo_material']?>">
    <div">
    Eliminar
    </div>
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


<?php require '../../includes/_footer.php' ?>
</body>

</html>