<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Materiales/Agregar material</h2></center>
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
<!-- Empieza la estructura del formulario recibe los campos: nombre,precio,cantidad
,categoria,proveedor y la imagen -->
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off" >

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text"  id="nombre" name="nombre" class="form-control" required >
</div>
</div>
</div>

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<label for="precio" class="form-label">Precio *</label>
<input type="real"  id="precio" name="precio"  class="form-control"  min="0" oninput="validar(this);" required>
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

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<label for="cantidad" class="form-label">Cantidad *</label>
<input type="number"  id="cantidad" name="cantidad" class="form-control" required min="0" oninput="validarPositivo(this);" required>
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

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<?php

$sql = "SELECT Codigo_catego,Nombre_cate FROM categoria";
$cate = mysqli_query($conexion, $sql);
if($cate -> num_rows > 0){
?>

 <label>Categoria*</label>
	<select name="Codigo_catego" class="form-label">
		
            <?php
                //solicitamos el valor por cada fila
                foreach($cate as $key => $row ){
                    //nos debe mostrar el nombre, segun el codigo es lo que recibe la funcion
            ?>
			<option value="<?php echo $row['Codigo_catego'] ?>"><?php echo $row['Nombre_cate']; ?></option>
            <?php
        }
}

    ?>
        </select>

        
</div>
</div>
</div>


<!-- SELECCIONAMOS EL NOMBRE DEL PROVEEDOR -->
<?php

$sql = "SELECT Codigo_provee,Nombre_prove FROM proveedores";
$provee = mysqli_query($conexion, $sql);
if($provee -> num_rows > 0){
?>

<div class="mb-3">
<div class="row">
<div class="col-sm-12">
<label>Proveedor*</label>
	<select name="Codigo_provee"  class="form-label">
		
            <?php
            //solicitamos el valor por cada fila
                foreach($provee as $key => $row ){
            //nos debe mostrar el nombre, segun el codigo es lo que recibe la funcion
            ?>
			<option value="<?php echo $row['Codigo_provee'] ?>"><?php echo $row['Nombre_prove']; ?></option>
            <?php
        }
}

    ?>
        </select>

</div>
</div>
</div>


                <!-- Solicitamos la imagen del material -->
                <div class="row">
<div class="col-sm-6">
<div class="mb-3">

<label for="foto" class="form-label">Desea Subir Imagen? *</label>
<select name="seleccion" id="seleccion" required onchange="mostrarCampoFoto()" class="form-control" required>
    <option value="selec">Seleccione...</option>
    <option value="si">Si</option>
    <option value="no">No</option>
    </select>
    <input type="file" class="form-control-file" name="foto" id="foto" style="display: none;">
    <script>
function mostrarCampoFoto() {
    var seleccion = document.getElementById('seleccion').value;
    var campoFoto = document.getElementById('foto');

    if (seleccion === 'si') {
        campoFoto.style.display = "block";
    } else {
        campoFoto.style.display = "none";
    }
}
</script>
            

<br>
<br>

<div class="mb-3">
<input type="hidden" name="accion" value="insertar_material">
<!--Enviamos los datos a la funcion que se encuentra en _functions-->
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
<?php require '../../includes/_footer.php' ?>
</html>