<?php

$id = $_GET['id'];

require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM proveedores WHERE Codigo_provee = $id";
$resultado = mysqli_query($conexion, $consulta);
$proveedores = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" >

<!-- <div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Codigo nuevo en numeros*</label>
<input type="number"  id="codigo" name="codigo" value="<?php echo $proveedores ['Codigo_provee']; ?>" class="form-control" required>
</div>
</div> -->

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre nuevo*</label>
<input type="text"  id="nombre" name="nombre" value="<?php echo $proveedores ['Nombre_prove']; ?>" class="form-control" required>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Descripcion nuevo*</label>
<textarea id="descripcion" name="descripcion" rows="5" cols="30">
<?php echo $proveedores ['Descripción']; ?>
</textarea>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-9">
<div class="mb-3">
<label for="nombre" class="form-label">Contacto nuevo*</label>
<input type="number"  id="contacto" name="contacto" value="<?php echo $proveedores ['Contacto']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-9">
<div class="mb-3">
<label for="correo" class="form-label">Correo nuevo*</label>
<textarea id="correo" name="correo" rows="1" cols="30">
<?php echo $proveedores ['correo']; ?>
</textarea>
</div>
</div>
</div>


<br>
<div class="mb-3">
<input type="hidden" name="accion" value="editar_proveedor">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<br>
<br>
<br>
<br>
<button type="submit" class="btn btn-success">Guardar Cambios</button>
</div>
</form>
</div>
</div>
</center>
</body>

</html>