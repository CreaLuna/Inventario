<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Clientes/Agregar Cliente</h2></center>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">
<!-- Codigo_client	Nombre	Region	Numero	 -->
<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre del cliente *</label>
<input type="text"  id="nombre_cli" name="nombre_cli" class="form-control" value="<?php echo isset($_SESSION['form_values']['nombre_cli']) ? $_SESSION['form_values']['nombre_cli'] : ''; ?>" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Region *</label>
<input type="text"  id="region" name="region" class="form-control" value="<?php echo isset($_SESSION['form_values']['region']) ? $_SESSION['form_values']['region'] : ''; ?>" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Numero de telefono *</label>
<input type="number"  id="telefno" min="0" name="telefono" class="form-control" oninput="validar(this);"  value="<?php echo isset($_SESSION['form_values']['telefono']) ? $_SESSION['form_values']['telefono'] : ''; ?>" required>
<script>
function validar(input) {
    if (input.value < 0) {
        input.setCustomValidity('Por favor, ingrese un número no negativo.');
    } else {
        input.setCustomValidity('');
    }
}
</script>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="correo" class="form-label">Correo *</label>
<input type="text"  id="correo" name="correo" class="form-control" value="<?php echo isset($_SESSION['form_values']['correo']) ? $_SESSION['form_values']['correo'] : ''; ?>" required>
</div>
</div>
</div>

<div class="mb-3">
<input type="hidden" name="accion" value="insertar_cliente">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
<?php require '../../../includes/_footer.php' ?>
</html>