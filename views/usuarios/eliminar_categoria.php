<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM categoria WHERE Codigo_catego = $id";
$resultado = mysqli_query($conexion, $consulta);
$categoria = mysqli_fetch_assoc($resultado);

?>



<!-- Modal -->
<div class="modal fade" id="eliminar_categoria.php?id=<?php echo $row['Codigo_catego'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
    <div class="alert alert-danger text-center">
  
    <p>¿Desea confirmar la eliminacion del registro?</p>
    <p>
    <tr>
    <td>
  
    <?php echo ($categoria ['Nombre_cate']);?>
</td>
</tr></p>
    </div>
    </div>
    </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form action="../../includes/_functions.php" method="POST">
            <input type="hidden" name="accion" value="eliminar_categorias">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" name="" value="eliminar" class="btn btn-success">
            <a href="./" class="btn btn-danger">cancelar</a>
        </div>
    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
   
