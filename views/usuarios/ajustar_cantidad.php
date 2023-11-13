<?php
require '../../includes/_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $accion = $_POST['accion'];

    if ($accion === "aumentar") {
        $query = "UPDATE materiales SET Cantidad = Cantidad + ? WHERE Codigo_material = ?";
    } else {
        $query = "UPDATE materiales SET Cantidad = Cantidad - ? WHERE Codigo_material = ?";
    }

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $cantidad, $id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Cantidad actualizada con éxito!";
    } else {
        echo "Error al actualizar la cantidad.";
    }

    $stmt->close();
  
}
?>
