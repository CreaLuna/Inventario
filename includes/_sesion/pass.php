<?php
require_once ("../_db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica la conexión a la base de datos.
    if ($conexion) {
        //comprobamos la contrasena
        $hashedPassword ='$2y$10$j1vbBJNM0DnGskycizo1P.SHF0Lu58psOo4Z4R67OH8Q9zEgcqHxi';
        //$hashedPassword = password_hash('admin', PASSWORD_DEFAULT);
        // Realiza la actualización en la base de datos.
        $consulta = "UPDATE usuarios SET Password = '$hashedPassword' WHERE 1";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            // La actualización fue exitosa.
            $response = array('success' => true);
        } else {
            // Error en la actualización.
            $response = array('success' => false);
        }

        // Cierra la conexión a la base de datos.
        mysqli_close($conexion);
    } else {
        // Error en la conexión a la base de datos.
        $response = array('success' => false);
    }

    // Devuelve una respuesta en formato JSON.
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si la solicitud no es POST, muestra un mensaje de error.
    echo 'Método no permitido';
}
