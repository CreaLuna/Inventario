<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
//Seleccionamos la categoria y proveedor cn un INNER JOIN
$consulta = "SELECT materiales.Codigo_material,materiales.Imagen,materiales.Nombre_mate,materiales.Cantidad,materiales.Precio,
materiales.Codigo_catego,materiales.Codigo_provee,proveedores.Nombre_prove, categoria.Nombre_cate FROM materiales INNER JOIN proveedores ON materiales.Codigo_provee= proveedores.Codigo_provee
INNER JOIN categoria ON materiales.Codigo_catego=categoria.Codigo_catego WHERE Codigo_material=$id";
$imagen="SELECT * FROM materiales Imagen WHERE Codigo_material=$id";
$resultado = mysqli_query($conexion, $consulta);
$materiales = mysqli_fetch_assoc($resultado);

$img = mysqli_query($conexion, $imagen);
$picture = mysqli_fetch_assoc($img);

?>

<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>
<center><h2>Materiales/ Editar Material</h2></center>
<!-- formulario 
Imagen	
Nombre	
Cantidad	
Precio	
Codigo_catego	
Codigo_provee	 -->
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" autocomplete="off">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label"> Actualizar Nombre*</label>
<input type="text"  id="nombre" name="nombre" value="<?php echo $materiales ['Nombre_mate']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label"> Actualizar Cantidad*</label>
<input type="number"  id="cantidad" name="cantidad" value="<?php echo $materiales ['Cantidad']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="precio" class="form-label">Actualizar Precio *</label>
<input type="real"  id="precio" name="precio" value="<?php echo $materiales ['Precio']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<?php

$sql = "SELECT Codigo_catego,Nombre_cate FROM categoria";
$cate = mysqli_query($conexion, $sql);
if($cate -> num_rows > 0){
?>

 <label>Actualizar Categoria*</label>
 
	<select name="Codigo_catego" class="form-label">
		
            <?php
            
                foreach($cate as $key => $row ){
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
<label>Actualizar Proveedor*</label>
	<select name="Codigo_provee"  class="form-label">
		
            <?php
            
                foreach($provee as $key => $row ){
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

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<img width="100" src="data:image;base64,<?php echo base64_encode($picture['Imagen']); ?>">
<label for="foto" class="form-label">Actualizar Imagen? *</label>
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






</div>

</div>
</div>
</div>

<div class="row">
<input type="hidden" name="accion" value="editar_material">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>

</body>
<?php require '../../includes/_footer.php' ?>
</html>