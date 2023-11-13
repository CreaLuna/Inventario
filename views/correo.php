
<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$para      = 'mariela26005@gmail.com';
$asunto    = 'PRUEBAAAAA';
$descripcion   = 'EHOLI HOLI';
$de = 'From: mariela26005@gmail.com';

if (mail($para, $asunto, $descripcion, $de))
   {
echo "Correo enviado satisfactoriamente";
    }
else
{
    echo "Correo No fue enviado";
}
?>