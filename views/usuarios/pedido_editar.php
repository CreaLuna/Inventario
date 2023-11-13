<?php

$id = $_GET['id'];

require_once ("../../includes/_db.php");
$consulta = "SELECT a.Codigo_pedi,c.Codigo_client,c.Nombre_clien,b.Nombre_produc,a.Cantidad,a.FormadePago,a.Fecha_solicitud,a.Fecha_entrega FROM pedidos a
INNER JOIN productos b
ON a.Codigo_product=b.Codigo_product
INNER JOIN clientes c
ON a.Codigo_client=c.Codigo_client";
$resultado = mysqli_query($conexion, $consulta);
$pedidos = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h1>Control de Pedidos/ Editar Pedido</h1></center>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre del Cliente*</label>
<input type="text"  id="cliente" name="cliente" value="<?php echo $pedidos ['Nombre_clien']; ?>" readonly class="form-control" required>

</div>
</div>
</div>


<!-- SELECCIONAMOS EL NOMBRE DEL Producto -->
<?php

$sql = "SELECT Codigo_product,Nombre_produc FROM productos";
$produ = mysqli_query($conexion, $sql);
if($produ -> num_rows > 0){
?>
<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label>Producto Nuevo*</label>
<input type="text"  id="nombreP" name="nombreP" value="<?php echo $pedidos ['Nombre_produc']; ?>"  class="form-control" readonly required>
	<select name="Codigo_product"  class="form-label">
        
            <?php
            
                foreach($produ as $key => $row ){
            ?>
            
			<option value="<?php echo $row['Codigo_product'] ?>"><?php echo $row['Nombre_produc']; ?></option>
            <?php
        }
}

    ?>
        </select>

</div>
</div>
</div>


<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label">Nueva Cantidad *</label>
<input type="number"  id="cantidad" name="cantidad" value="<?php echo $pedidos ['Cantidad']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<label for="precio" class="form-label">Cambio de Precio *</label>
<input type="real"  id="precio" name="precio"  class="form-control"  min="0" oninput="validar(this);"  value="<?php echo isset($_SESSION['form_values']['precio']) ? $_SESSION['form_values']['precio'] : ''; ?>" required>
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
<label for="descripcion" class="form-label"> Nueva Fecha de Solicitud *</label>
<input type="datetime-local"  id="fecha_soli" name="fecha_soli" value="<?php echo $pedidos ['Fecha_solicitud']; ?>" class="form-control" required >
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="color" class="form-label">Nueva Fecha entrega</label>
<input type="datetime-local"  id="fecha_e" name="fecha_e" value="<?php echo $pedidos ['Fecha_entrega']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label">Nuevo Tipo de Pago </label>
<select name="pago" id="pago"  class="form-control" required>
    <option value="efectivo" <?php if ($pedidos['FormadePago'] == 'efectivo') echo 'selected'; ?>>Efectivo</option>
    <option value="Tarjeta" <?php if ($pedidos['FormadePago'] == 'Tarjeta') echo 'selected'; ?>>Tarjeta</option>

</div>
</div>
</div>



<div class="mb-3">
<input type="hidden" name="accion" value="editar_pedido">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>

</div>
</form>
</div>
</div>
</body>
<?php require '../../../includes/_footer.php' ?>
</html>