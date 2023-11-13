<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/**
 * Validacion de datos para poder iniciar sesion
 */
require_once ("../_db.php");

$usuario = $_POST['user'];
$passwordIngresada = $_POST['password'];
$conexion=mysqli_connect("localhost","root","","tienda");
$stmt = $conexion->prepare("SELECT Password FROM usuarios WHERE Usuario = ?");
$stmt->bind_param('s', $usuario);
$stmt->execute();
$stmt->bind_result($passwordHasheadaDb);
$stmt->fetch();
$stmt->close();

if (password_verify($passwordIngresada, $passwordHasheadaDb))
{
  // Si retorna true, la contraseña ingresada es correcta.
  session_start();
  $_SESSION['user'] = $usuario;
  header('Location: ../../index.php');
  exit();
} else {
  // Si retorna false, la contraseña es incorrecta.
  header('Location: ../../index.php?error=1');
  exit();
}
?>
  
  <?php

  /**
   * Parte de registro de usuarios
   */

  if(isset ($_POST['registrar'])){
 if (strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['password']) >= 1) {
       $nombre = trim($_POST['nombre']);
       $correo = trim($_POST['correo']);
       $password = trim($_POST['password']);
       $passwordF=hash('sha512',$password);
    
      $consulta = "INSERT INTO usuarios (Usuario, Password, Correo)
      VALUES ('$nombre', '$passwordF', '$correo')";
      mysqli_query($conexion, $consulta);
      mysqli_close($conexion);

    
      

  }
 }
?>







