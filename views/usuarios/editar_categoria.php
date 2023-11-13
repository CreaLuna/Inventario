<?php

$id = $_GET['id'];

require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM categoria WHERE Codigo_catego = $id";
$categoria = mysqli_query($conexion, $consulta);
$categoria = mysqli_fetch_assoc($categoria);

?>

<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data" >

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre nuevo*</label>
<input type="text"  id="categoria" name="categoria" value="<?php echo $categoria ['Nombre_cate']; ?>" class="form-control" required>
</div>
</div>


<div class="mb-3">
<input type="hidden" name="accion" value="editar_categorias">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
<?php require '../../includes/_footer.php' ?>
</html>