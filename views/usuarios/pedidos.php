<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php'?>

<body>
<center><h1>Control de Pedidos</h1></center>
<center><h4><?php
date_default_timezone_set('America/El_Salvador');
$DateAndTime = date('Y-m-d h:i a', time());  
echo "FECHA Y HORA ACTUAL: ".$DateAndTime;
?> </h4></center>
<style>
        /* Estilo para el rectángulo */
        .status-box {
            display: inline-block;
            width: 25px;
            height: 25px;
            
            margin-right: 10px; /* Espacio entre el rectángulo y el texto */
            vertical-align: middle; /* Para alinear verticalmente el rectángulo con el texto */
        }
            /* Estilo para el rectángulo */
        .status-box2 {
            display: inline-block;
            width: 25px;
            height: 25px;
            
            margin-right: 5px; /* Espacio entre el rectángulo y el texto */
            vertical-align: middle;
          }
    </style>

</div>
<div class="col-sm-12">
<div class="table-responsive">
  
<!-- CONTROL PARA BUSCAR EN LA TABLA PEDIDOS -->

<!-- ------Muestra el mensaje de la funcion-------- -->
<?php
 echo '<span class="status-box" ></span> Entregado <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M6 0a6 6 0 1 1 0 12A6 6 0 0 1 6 0Zm-.705 8.737L9.63 4.403 8.392 3.166 5.295 6.263l-1.7-1.702L2.356 5.8l2.938 2.938Z"></path></svg> |  ';
 
  echo '<span class="status-box2"></span>No entregado';
?>
<table class="table table-striped table-hover">
<thead>
<!-- Id
DUI
Codigo_product
Cantidad
Precio_uni
Total
FormadePago
Fecha_solicitud
Fecha_entrega
Estado -->

<tr>
<th>Pedido N*</th>
<th>DUI cliente</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio Venta</th>
<th>Total</th>
<th>Forma de Pago</th>
<th>Fecha Solicitud</th>
<th>Fecha entrega</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>
<!-- Id
DUI
Codigo_product
Cantidad
Precio_uni
Total
FormadePago
Fecha_solicitud
Fecha_entrega
Estado -->
<?php

$sql = "SELECT a.Id,a.Precio_uni,c.DUI,b.Nombre_produc,a.Cantidad,a.Total,a.FormadePago,a.Fecha_solicitud,a.Fecha_entrega,a.Estado FROM pedidos a
INNER JOIN productos b
ON a.Codigo_product=b.Codigo_product
INNER JOIN clientes c
ON a.DUI=c.DUI";
$pedidos = mysqli_query($conexion, $sql);
if($pedidos -> num_rows > 0){
foreach($pedidos as $key => $row ){
?>

<!-- empieza la tabla-->
<tr>
<td><?php echo $row['Id']; ?>
<?php
        // Verifica el estado y muestra el icono correspondiente
        if ($row['Estado'] == 'Entregado') {
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M6 0a6 6 0 1 1 0 12A6 6 0 0 1 6 0Zm-.705 8.737L9.63 4.403 8.392 3.166 5.295 6.263l-1.7-1.702L2.356 5.8l2.938 2.938Z"></path></svg>';
        }
        ?>
</td>
<td><?php echo $row['DUI']; ?></td>
<td><?php echo $row['Nombre_produc']; ?></td>
<td><?php echo $row['Cantidad']; ?></td>
<td><?php echo $row['Precio_uni'];?></td>
<td><?php echo $row['Total'];?></td>
<td><?php echo $row['FormadePago']; ?></td>
<td><?php echo $row['Fecha_solicitud'];?></td>

<td style=" color:#000000;
font-weight: bold;
background-color: 
                <?php
                date_default_timezone_set('America/El_Salvador');
                $fecha_actual = date('Y-m-d h:i:s a', time()); 
                      //si la fecha ya paso
                    if ($row['Fecha_entrega'] < $fecha_actual) 
                    {
                        echo 'red';
                        //si la fecha es de ahora 
                    } elseif ($row['Fecha_entrega'] ==$fecha_actual) 
                    {
                        echo 'green';
                    
                    } else 
                    {
                      //la falta para la entrega
                        echo 'yellow';
                        
                    }
                ?>">
                    <?php echo $row['Fecha_entrega']; ?>
</td>
<td><?php echo $row['Fecha_entrega'];?></td>
<td><?php echo $row['Estado'];?></td>
<td>
                    <!-- Example single danger button -->
<div class="btn-group">
<a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Acciones
</a>
  <div class="dropdown-menu">
    <!-- verificar como validar la entrega de pedido -->
    <a class="dropdown-item" name="Id" value="<?php echo $_GET['Id']; ?>" href="update_status.php" onclick="updateStatus('Entregado', <?php echo $row['Id']; ?>)" >Entregado <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M6 0a6 6 0 1 1 0 12A6 6 0 0 1 6 0Zm-.705 8.737L9.63 4.403 8.392 3.166 5.295 6.263l-1.7-1.702L2.356 5.8l2.938 2.938Z"></path></svg></a>
    <a class="dropdown-item" href="#">No entregado</a>
    <a class="dropdown-item" href="#">Cancelado</a>
  </div>
</div>  
</td>
</tr>
<script>
    function updateStatus(status, id) {
        // Envía una solicitud AJAX para actualizar el estado en la base de datos
        $.ajax({
            type: 'POST',
            url: 'update_status.php', 
            data: { id: id, status: status },
            success: function (response) {
                // Actualiza el contenido en la celda de estado y muestra el icono correspondiente
                var statusCell = $('#status_' + id);
                statusCell.empty();

                if (status === 'Entregado') {
                    statusCell.html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" width="12" height="12"><path d="M6 0a6 6 0 1 1 0 12A6 6 0 0 1 6 0Zm-.705 8.737L9.63 4.403 8.392 3.166 5.295 6.263l-1.7-1.702L2.356 5.8l2.938 2.938Z"></path></svg>');
                }
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
</script>
<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="4">No existe registros</td>
    </tr>

    <?php
}?>
</tbody>

</table>
</div>
</div>
</div>
</div>
        </section>


        <section>
            <div class= "container">
                <div class= "row">
                    <div class= "col-lg-9">
            </div>
        </section>
    </div>
    <?php require '../../includes/_footer.php' ?>
</html


