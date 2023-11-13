<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Control de Pedidos/ Agregar Pedido</h2></center>
<!-- iniciamos la Sesion Para que envie el mensaje de la funcion -->
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
$query = "SELECT MAX(Codigo_pedi) AS ultimo_id FROM pedidos";
$result = $conexion->query($query);
$fila = $result->fetch_assoc();

$ultimo_id = $fila['ultimo_id'];
$siguiente_id = $ultimo_id + 1;
?>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">
<!-- Codigo_pedi	ID_usuario	Codigo_product	Cantidad	
Codigo_client	FormadePago	Fecha_solicitud	Fecha_entrega	 -->

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="codigoP" class="form-label" >Codigo Pedido*</label>
<input type="number"  id="codigoP" name="codigoP" readonly class="form-control" value="<?php echo $siguiente_id; ?>" required>
</div>
</div>
</div>
<!-- SELECCIONAMOS EL NOMBRE DEL CLIENTE -->
<?php

$sql = "SELECT Codigo_client,Nombre_clien FROM clientes";
$cli = mysqli_query($conexion, $sql);
if($cli -> num_rows > 0){
?>
<div class="col-sm-6">
<div class="mb-3">
<label>Cliente*</label>
	<select name="Codigo_client"  class="form-label">
	
            <?php
            
                foreach($cli as $key => $row ){
            ?>
			<option value="<?php echo $row['Codigo_client'] ?>"><?php echo $row['Nombre_clien']; ?></option>
            <?php
        }
}

    ?>
        </select>
    
</div>
</div>
<!-- SELECCIONAMOS EL NOMBRE DEL Producto -->
<div id="productos">
<?php

$sql = "SELECT Codigo_product,Nombre_produc FROM productos";
$produ = mysqli_query($conexion, $sql);
if($produ -> num_rows > 0){
?>

<div class="col-sm-6">
<div class="mb-3">
<label>Producto*</label>
	<select name="Codigo_product[]"  class="form-label">
        
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

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" min="0" class="form-label">Cantidad*</label>
<input type="number"  id="cantidad[]" name="cantidad[]" class="form-control" required min="0" oninput="validarPositivo(this);" value="<?php echo isset($_SESSION['form_values']['cantidad']) ? $_SESSION['form_values']['cantidad'] : ''; ?>">
<script>
function validarPositivo(input) {
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
</div>

<div class="mb-3">
<div class="col-sm-6">
<div class="row">
<label for="precio" class="form-label">Precio venta *</label>
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


<button onclick="agregarProducto()">Agregar otro producto</button>
    <br>
<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="fecha_soli" class="form-label">Fecha de Solicitud *</label>
<input type="datetime-local"  id="fecha_soli" name="fecha_soli" class="form-control" value="<?php echo isset($_SESSION['form_values']['fecha_soli']) ? $_SESSION['form_values']['fecha_soli'] : ''; ?>" required >
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="fecha" class="form-label">Fecha entrega</label>
<input type="datetime-local"  id="fecha_e" name="fecha_e" class="form-control" value="<?php echo isset($_SESSION['form_values']['fecha_e']) ? $_SESSION['form_values']['fecha_e'] : ''; ?>" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="pago" class="form-label">Forma de Pago *</label>
<select name="pago" id="pago" class="form-control" required>
    <option value="selec">Seleccione...</option>
    <option value="Efectivo">Efectivo</option>
    <option value="Tarjeta">Tarjeta</option>
</div>
</div>
</div>
<script>
 
        // Añade campos para otro producto.
        function agregarProducto() {
    // Obtener el select original y sus opciones
    var selectOriginal = document.querySelector('select[name="Codigo_product[]"]');
    var opciones = selectOriginal.innerHTML;

    // Crear el nuevo select con las opciones y añadirlo al div de productos
    var divProductos = document.getElementById('productos');
    var nuevoProducto = '<div class="col-sm-6"><div class="mb-3"><label>Producto*</label><select name="Codigo_product[]" class="form-label">' + opciones + '</select></div></div><div class="col-sm-6"><div class="mb-3"><label for="cantidad" class="form-label">Cantidad*</label><input type="number" name="cantidad[]" class="form-control" required min="0" oninput="validarPositivo(this);"></div></div><br>';
    divProductos.innerHTML += nuevoProducto;
}
    
</script>
<div class="mb-3">
<input type="hidden" name="accion"  value="insertar_pedido" >
<button type="submit" class="btn btn-success" >Guardar</button>
</div>

</form>

</div>
</div>
</body>
<?php require '../../../includes/_footer.php' ?>
</html>