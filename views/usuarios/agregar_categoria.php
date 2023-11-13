<!DOCTYPE html>
<html lang="es-MX">

<body>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar categoria
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><center><h2>Agregar Categoria</h2></center></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
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
<?php
// Obtener el ID más grande (último registrado)
$query = "SELECT MAX(Codigo_catego) AS ultimo_id FROM categoria";
$result = $conexion->query($query);
$fila = $result->fetch_assoc();

$ultimo_id = $fila['ultimo_id'];
$siguiente_id = $ultimo_id + 1;
?>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">

<div class="col-sm-6">
<div class="mb-3">
<label for="codigo" class="form-label">Codigo *</label>
<input type="number"  id="codigo" name="codigo" value="<?php echo $siguiente_id; ?>" class="form-control" min="1" required required>
</div>
</div>

<div class="col">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text"  id="categoria" name="categoria" class="form-control" required>
</div>
</div>

<div class="mb-3">
<input type="hidden" name="accion"  value="insertar_categorias" >
<button type="submit" class="btn btn-success" >Guardar</button>
</div>
</form>
</div>
</div>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>

</body>

</html>