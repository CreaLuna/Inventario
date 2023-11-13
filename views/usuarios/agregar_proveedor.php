<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Proveedores/Agregar Proveedor</h2><center>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text"  id="nombre" name="nombre" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Descripcion *</label>
<textarea id="descripcion" name="descripcion" rows="4" cols="50" class="form-control" required>

</textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="contacto" class="form-label">Contacto *</label>
<input type="number"  id="contacto" name="contacto" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="correo" class="form-label">Correo *</label>
<input type="text"  id="correo" name="correo" class="form-control" required>
</div>
</div>
</div>


<div class="mb-3">
<input type="hidden" name="accion" value="insertar_proveedor">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
<?php require '../../../includes/_footer.php' ?>
</html>