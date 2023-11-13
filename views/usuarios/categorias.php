<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>


<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Categorias</h1></center>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<?php include 'agregar_categoria.php';?>
<!-- <div class="row">
    <div class="col-sm-12">
    <a href="agregar_categoria.php"><input  class="btn btn-primary" type="button" value="Agregar Categoria"></a>
    </div>
</div> -->

<div class="col-sm-12">
   <!-- CONTROL PARA BUSCAR EN LA TABLA CATEGORIAS -->

<h4>Buscador</h4>

<form action="index.php" method="POST">
<input type="text" name="buscar">
<input type="submit"  value="Buscar">
</form>
<!-- -------------- -->
<div class="table-responsive">


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Codigo Categoria</th>
<th>Nombre Categoria</th>
</tr>

</thead>

<tbody>

<?php

$sql = "SELECT * FROM categoria";
$categoria = mysqli_query($conexion, $sql);
if($categoria -> num_rows > 0){
foreach($categoria as $key => $row ){
?>

<!-- empieza la tabla-->
<tr>
<td <?php echo  'class="'.$row['id'] .'"'; ?>><?php echo $row['Codigo_catego']; ?></td>	
<td><?php echo $row['Nombre_cate']; ?></td>



<td>
  <a href="editar_categoria.php?id=<?php echo $row['Codigo_catego']?>">
    <div">
      Editar
    </div>
  </a>
  
  <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar_categoria.php?id=<?php echo $row['Codigo_catego']?>">
  Borrar
</button>
   
</td>
</tr>
<?php include 'eliminar_categoria.php';?>
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

</div>
</body>
<?php require '../../includes/_footer.php' ?>
</html>