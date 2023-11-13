<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM clientes WHERE Codigo_client = $id";
$resultado = mysqli_query($conexion, $consulta);
$cliente = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
    <div class="alert alert-danger text-center">
    <p>¿Desea Activar el registro: "<?php echo ($cliente ['Nombre_clien']);?> "?</p>
    <p>
    <tr>
    <td>
    
</td>
</tr>
</p>
    </div>
 

    <div class="row">
        <div class="col-sm-6">
            <form action="../../includes/_functions.php" method="POST">
            <input type="hidden" name="accion" value="activar_cliente">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" name="" value="Activar" class="btn btn-success">
            <a href="clientes.php" class="btn btn-danger">cancelar</a>
        </div>
    </div>

    
</body>
    </html>