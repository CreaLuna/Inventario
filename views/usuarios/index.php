<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>

<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Productos</h1></center>
<!--MENSAJE DE CONFIRMACION  -->
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<a href="producto_agregar.php"><input  class="btn btn-primary" type="button" value="Agregar producto"></a>
</div>
<div class="col-sm-12">
<div class="table-responsive">

 <!-- CONTROL PARA BUSCAR EN LA TABLA PRODUCTOS -->

 <h4>Buscador</h4>

<form action="index.php" method="POST">
<input type="text" name="buscar">
<input type="submit"  value="Buscar">
</form>
<!-- -------------- -->
<table class="table table-striped table-hover">
<thead>

<tr>
<th>Codigo</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Precio</th>
<th>Imagen</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php
$imagenNull = "../../img/no_disponible.png";
$sql = "SELECT * FROM productos";
$productos = mysqli_query($conexion, $sql);
if($productos -> num_rows > 0){
foreach($productos as $key => $row ){
?>
<tr>
<td <?php echo  'class="'.$row['id'] .'"'; ?>><?php echo $row['Codigo_product']; ?></td>
<td><?php echo $row['Nombre_produc']; ?></td>
<td><?php echo $row['Descripcion']; ?></td>
<td><?php echo $row['Precio']; ?></td>
<?php 
if (empty($row['imagen'])) {
    // Si no hay imagen en la base de datos, muestra la imagen por defecto
    echo '<td><img width="100" src="' . $imagenNull . '"></td>';
} else {
    // Si hay imagen en la base de datos, muestra esa imagen
    echo '<td><img width="100" src="data:image;base64,' . base64_encode($row['imagen']) . '"></td>';
}
?>
<td>
  <a href="producto_editar.php?id=<?php echo $row['Codigo_product']?>">
    <div">
      Editar
    </div>
  </a>
  <a>|</a>
  <a href="producto_eliminar.php?id=<?php echo $row['Codigo_product']?>">
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
</div>
</div>
</div>
</div>
        </section>


        <section>
            <div class= "container">
                <div class= "row">
                    <div class= "col-lg-9">
            </div>
        </section>
    </div>
    <?php require '../../includes/_footer.php' ?>
</html
