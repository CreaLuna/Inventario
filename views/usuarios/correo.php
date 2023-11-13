<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
$consulta = "SELECT Correo FROM usuarios WHERE ID_usuario = $id";
$resultado = mysqli_query($conexion, $consulta);
$user = mysqli_fetch_assoc($resultado);

?>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" >

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="contra" class="form-label">Correo actual*</label>
<input type="text"  id="correoA" name="correoA" value="<?php echo $user ['Correo']; ?>" readonly class="form-control" required>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="contra" class="form-label">Nuevo Correo*</label>
<input type="text"  id="correo" name="correo" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="contra" class="form-label">Contraseña Actual *obligatoria*</label>
<input type="password"  id="contraA" name="contraA" class="form-control" required>
</div>
</div>
</div>


<div class="mb-3">
<input type="hidden" name="accion" value="correo">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
<?php require '../includes/_footer.php' ?>
</html>