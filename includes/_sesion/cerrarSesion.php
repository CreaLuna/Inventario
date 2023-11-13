<div class="spinner-border text-success" role="status">
  <span class="visually-hidden">Cargando...</span>
</div>
<?php
    session_start();
    session_destroy();
    header("Location: ../../index.php")

?>
