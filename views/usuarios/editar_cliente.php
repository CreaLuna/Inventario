<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM clientes WHERE Codigo_client = $id";
$resultado = mysqli_query($conexion, $consulta);
$clientes = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Clientes/ Editar Cliente</h2></center>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label"> Actualizar Nombre*</label>
<input type="text"  id="nombre" name="nombre" value="<?php echo $clientes ['Nombre_clien']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label"> Actualizar Region*</label>
<input type="text"  id="region" name="region" value="<?php echo $clientes ['Region']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="precio" class="form-label">Actualizar Numero *</label>
<input type="number"  id="numero" name="numero" value="<?php echo $clientes ['Numero']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="categoria" class="form-label">Actualizar Correo *</label>
<input type="text"  id="correo" name="correo" value="<?php echo $clientes ['correo']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<input type="hidden" name="accion" value="editar_cliente">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>

</body>
<?php require '../../includes/_footer.php' ?>
</html>