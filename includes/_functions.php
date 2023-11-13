<?php

require_once ("_db.php");


if(isset($_POST['accion'])){ 
    switch($_POST['accion']){
        case 'cambiar':
            cambiar();

        break;
        case 'correo':
            correo();

        break;
        //ACCIONES PARA PRODUCTOS
        case 'eliminar_producto':
            eliminar_producto();

        break;        
        case 'editar_producto':
        editar_producto();

        break;

        case 'insertar_producto':
        insertar_producto();

        break;    

            //ACCIONES PARA CATEGORIAS
        case 'insertar_categorias':
            insertar_categorias();
    
       break; 
       case 'editar_categorias':
           editar_categorias();

        break; 
        case 'eliminar_categorias':
            eliminar_categorias();
 
         break; 

         //ACCIONES PARA PEDIDOS
         case 'insertar_pedido':
            insertar_pedido();
       break; 
       case 'editar_pedido':
           editar_pedido();
        break; 
        case 'eliminar_pedido':
            eliminar_pedido();
        break;
         //ACCIONES PARA CLIENTES
         case 'insertar_cliente':
            insertar_cliente();
    
       break; 
       case 'editar_cliente':
           editar_cliente();

        break; 
        case 'desactivar_cliente':
            desactivar_cliente();
            break; 
            case 'activar_cliente':
                activar_cliente();
                break; 
         //ACCIONES PARA PROVEEDORES
         case 'insertar_proveedor':
            insertar_proveedor();
    
       break; 
       case 'editar_proveedor':
           editar_proveedor();

        break; 
        case 'eliminar_proveedor':
            eliminar_proveedor();
            break; 
         //ACCIONES PARA REPORTERIA?
         case 'insertar_reporte':
            insertar_reporte();
    
       break; 
       case 'editar_reporte':
           editar_reporte();

        break; 
        case 'eliminar_reporte':
            eliminar_reporte();
            break; 
            //ACCIONES PARA MATERIALES
        case 'eliminar_material':
            eliminar_material();

        break;        
        case 'editar_material':
        editar_material();

        break;

        case 'insertar_material':
        insertar_material();

        break; 
    }
}
function correo(){
    global $conexion;
    extract($_POST);
    session_start();
    $id = $_POST['id'];
    

$id = $_POST['id'];
$passwordIngresada = $_POST['contraA'];
//comprobamos la contrasena
$stmt = $conexion->prepare("SELECT Password FROM usuarios WHERE ID_usuario = ?");
$stmt->bind_param('s', $id);
$stmt->execute();
$stmt->bind_result($passwordHasheadaDb);
$stmt->fetch();
$stmt->close();
$consulta="UPDATE usuarios SET Correo='$correo' WHERE ID_usuario = $id";
if (password_verify($passwordIngresada, $passwordHasheadaDb)) {
  // Si retorna true, el correo ingresado es correcto.
  mysqli_query($conexion, $consulta);
  $_SESSION['message'] = 'Correo Actualizado!';
        $_SESSION['message_type'] = 'success';
  header('Location: ../views/usuarios/index.php');
  exit();
} else {
  // Si retorna false, el correo ingresado es incorrecta.
    $_SESSION['message'] = 'Error! Correo no actualizado!';
    $_SESSION['message_type'] = 'danger';
  header('Location: ../views/usuarios/index.php');
  exit();
}
}


function cambiar(){
    global $conexion;
    // Obtén los valores del POST
    $id = $_POST['id']; 
    $pass = $_POST['contra'];
    $actualpass = $_POST['contraA'];
    
    // Verifica la contraseña actual
    $stmt = $conexion->prepare("SELECT Password FROM usuarios WHERE ID_usuario = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($actualpass, $hashedPassword)) {
        // La contraseña actual no coincide con la almacenada en la base de datos
        
        $_SESSION['message'] = 'Contrasena Actual NO VALIDA!';
        $_SESSION['message_type'] = 'danger';
        header('Location: ../views/usuarios/cambiar.php');
        exit();
    } else {
        // Cambia la contraseña
        $newHashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE usuarios SET Password = ? WHERE ID_usuario = ?");
        $stmt->bind_param('ss', $newHashedPassword, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = '¡Operación exitosa, Actualizado Correctamente!';
        $_SESSION['message_type'] = 'success';

        // Destruye la sesión como medida de seguridad
        session_start();
        $_SESSION = array();
        session_destroy();
        
        header('Location: ../index.php'); // Redirige al inicio o a la página de login
        exit();
    }    
}
function insertar_material(){

    global $conexion;
    extract($_POST);
    session_start();
    $Codigo_provee=$_POST['Codigo_provee'];
    $Codigo_catego=$_POST['Codigo_catego'];
 
    
   // Subir imagen segun lo requiera
   $seleccion = $_POST['seleccion'];
   if ($seleccion === 'no') 
       {
        $consulta="INSERT INTO materiales (Nombre_mate,Cantidad,Precio,Codigo_catego,Codigo_provee)
        VALUES ('$nombre','$cantidad','$precio','$Codigo_catego','$Codigo_provee');" ;
 $ejecutar=mysqli_query($conexion, "SELECT * FROM materiales WHERE Precio");
 if($Codigo_catego=="" && $Codigo_provee=="")
 {
     //Campo vacio
 $_SESSION['message'] = 'Hubo un error al insertar el material. Seleccione una categoria y proveedor!';
 $_SESSION['message_type'] = 'danger';
 // Guardar valores del formulario en la sesión
 $_SESSION['form_values'] = $_POST;
 }
// Ejecuta el query 
if($consulta)
{
//Todo correcto
session_start();
mysqli_query($conexion, $consulta);
$_SESSION['message'] = 'Material agregado Correctamente!';
$_SESSION['message_type'] = 'success';
// Guardar valores del formulario en la sesión
$_SESSION['form_values'] = $_POST;
header('Location: ../views/usuarios/agregar_material.php');
exit();
}
}
else
{
//caso si desea modificar la imagen tambien

    //variables donde se almacenan los valores de nuestra imagen
$tamanoArchvio=$_FILES['foto']['size'];
//se realiza la lectura de la imagen
       $imagenSubida=fopen($_FILES['foto']['tmp_name'], 'r');
       $binariosImagen=fread($imagenSubida,$tamanoArchvio);   
//se realiza la consulta correspondiente para guardar los datos
$imagenFin =mysqli_escape_string($conexion,$binariosImagen);

$consulta="INSERT INTO materiales (Imagen,	Nombre_mate,Cantidad,Precio,Codigo_catego,Codigo_provee)
        VALUES ('$imagenFin','$nombre','$cantidad','$precio','$Codigo_catego','$Codigo_provee');" ;
// Ejecuta el query de actualización
if($consulta)
{
//Todo correcto
session_start();
mysqli_query($conexion, $consulta);
$_SESSION['message'] = 'Material agregado Correctamente!';
$_SESSION['message_type'] = 'success';
// Guardar valores del formulario en la sesión
$_SESSION['form_values'] = $_POST;
header('Location: ../views/usuarios/agregar_material.php');
exit();
}
}
}
function editar_material(){
    global $conexion;
    extract($_POST);
    
    $Codigo_provee=$_POST['Codigo_provee'];
    $Codigo_catego=$_POST['Codigo_catego'];
     //si solo se quiere cambiar datos de texto y numeros, pero no la imagen
    $seleccion = $_POST['seleccion'];
    if ($seleccion === 'no') 
    {
        $actualImg = "SELECT Imagen FROM materiales WHERE Codigo_material = '$id'";
        $consulta = "UPDATE materiales SET Nombre_mate='$nombre',Cantidad='$cantidad',Precio='$precio',Codigo_catego='$Codigo_catego',Codigo_provee='$Codigo_provee' WHERE Codigo_material='$id'";
        // Ejecuta el query de actualización
        if($consulta)
        {
        //Todo correcto
        session_start();
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = 'Material actualizado Correctamente!';
        $_SESSION['message_type'] = 'success';
        // Guardar valores del formulario en la sesión
        $_SESSION['form_values'] = $_POST;
        header('Location: ../views/usuarios/materiales.php');
        exit();
        }
    }
    else
    {
        //caso si desea modificar la imagen tambien
        
             //variables donde se almacenan los valores de nuestra imagen
        $tamanoArchvio=$_FILES['foto']['size'];
        //se realiza la lectura de la imagen
                $imagenSubida=fopen($_FILES['foto']['tmp_name'], 'r');
                $binariosImagen=fread($imagenSubida,$tamanoArchvio);   
        //se realiza la consulta correspondiente para guardar los datos
        $imagenFin =mysqli_escape_string($conexion,$binariosImagen);
       
            $consulta = "UPDATE materiales SET Imagen='$imagenFin',Nombre_mate='$nombre',Cantidad='$cantidad',Precio='$precio',Codigo_catego='$Codigo_catego',Codigo_provee='$Codigo_provee' WHERE Codigo_material='$id'";
        // Ejecuta el query de actualización
        if($consulta)
        {
        //Todo correcto
        session_start();
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = 'Material actualizado Correctamente!';
        $_SESSION['message_type'] = 'success';
        // Guardar valores del formulario en la sesión
        $_SESSION['form_values'] = $_POST;
        header('Location: ../views/usuarios/materiales.php');
        exit();
        }
    }

   
}

function eliminar_material(){

    global $conexion;
    extract($_POST);
    session_start();
    $id = $_POST['id'];
    $consulta = "DELETE FROM materiales WHERE Codigo_material = $id";
    
    if($consulta)
        {
        //Datos correctos
        mysqli_query($conexion, $consulta);
        
        $_SESSION['message'] = '¡Operación exitosa, Eliminado Correctamente!';
        $_SESSION['message_type'] = 'success';
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al Borrar,Intentelo de nuevo';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/materiales.php');
    exit();
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/// INSERTAR PEDIDOS
function insertar_pedido(){

    global $conexion;
    extract($_POST);
    session_start();
    $Codigo_client=$_POST['Codigo_client'];
    $productos = $_POST['Codigo_product'];
    $cantidades = $_POST['cantidad'];
    
    //Datos correctos
    for ($i = 0; $i < count($productos); $i++) {
        $producto = $productos[$i];
        $cantidad = $cantidades[$i];
    
        // Suponiendo que tengas una tabla "pedidos" donde guardes la información.
        $consulta = "INSERT INTO pedidos (Codigo_pedi,ID_usuario,Codigo_product,
        Cantidad,Precio,Codigo_client,FormadePago,Fecha_solicitud,Fecha_entrega) 
        VALUES ('$codigoP',1, '$producto', '$cantidad','$precio', '$Codigo_client', '$pago','$fecha_soli','$fecha_e');";
        mysqli_query($conexion, $consulta);
    }
    $_SESSION['message'] = '¡Operación exitosa! Pedido Registrado';
    $_SESSION['message_type'] = 'success';
    // Limpiar los valores del formulario en la sesión
    unset($_SESSION['form_values']);
    
    header('Location: ../views/usuarios/pedidos.php');
    exit();

    // //BUSCAMO EN LA BASE SI SE REPITE EL ID
    // $validarID=mysqli_query($conexion, "SELECT * FROM pedidos WHERE 
    // Codigo_pedi='$codigoP'");
    // if(mysqli_num_rows($validarID)>0)
    // {
    //     //Campo vacio
    // $_SESSION['message'] = 'Hubo un error al insertar el pedido. Seleccione un Codigo diferente!';
    // $_SESSION['message_type'] = 'danger';
    // // Guardar valores del formulario en la sesión
    // $_SESSION['form_values'] = $_POST;
    // header('Location: ../views/usuarios/pedido_agregar.php');
    // exit();
    // }else{
    
    
}
/// editar PEDIDO
function editar_pedido(){

    global $conexion;
    session_start();
    extract($_POST);
    $Codigo_product=$_POST['Codigo_product'];
    $idcliente=mysqli_query($conexion,"SELECT Codigo_client FROM clientes WHERE Nombre_clien='$cliente'");
    $consulta="UPDATE pedidos SET Codigo_product='$Codigo_product',Cantidad='$cantidad',Precio='$precio',FormadePago='$pago',Fecha_solicitud='$fecha_soli',Fecha_entrega = '$fecha_e' WHERE Codigo_Pedi = $id";
  
    if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa! Pedido actualizado';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al editar el pedido';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/pedidos.php');
    exit();

}
// ELIMINAR PEDIDO
function eliminar_pedido(){

    global $conexion;
    extract($_POST);
    $id = $_POST['id'];
    if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa! Pedido Eliminado';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al eliminar el pedido';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/pedidos.php');
    exit();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// INSERTAR CATEGORIA
    function insertar_categorias(){
        global $conexion;
        session_start();
        extract($_POST);
        $categoria=$_POST['categoria'];
        $codigo=$_POST['codigo'];
        
        $consulta="INSERT INTO categoria (Codigo_catego,Nombre_cate)
        VALUES ('$codigo','$categoria');" ;
        
        //BUSCAMO EN LA BASE SI SE REPITE EL ID
        $validarID=mysqli_query($conexion, "SELECT * FROM categoria WHERE 
        Codigo_catego='$codigo'");
        if(mysqli_num_rows($validarID)>0)
        {
            //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al insertar. ID existente';
        $_SESSION['message_type'] = 'danger';
        }else{
            
        //Datos correctos
        mysqli_query($conexion, $consulta);
         $_SESSION['message'] = '¡Operación exitosa!';
        $_SESSION['message_type'] = 'success';
        }
        header('Location: ../views/usuarios/categorias.php');
    exit(); 
    }
    /// editar CATEGORIA
    function editar_categorias(){

        global $conexion;
        extract($_POST);
    
    
        $consulta="UPDATE categoria SET Nombre_cate = '$categoria' WHERE Codigo_catego = $id";
    
        if($consulta)
        {
        //Datos correctos
        mysqli_query($conexion, $consulta);
        echo "<script>
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
          )
        <script>";
        // $_SESSION['message'] = '¡Operación exitosa, Actualizado Correctamente!';
        // $_SESSION['message_type'] = 'success';
       
        
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al Actualizar,verifique los campos';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/categorias.php');
    exit();
    
    }
    // ELIMINAR CATEGORIA
    function eliminar_categorias(){

        global $conexion;
        extract($_POST);
        $id = $_POST['id'];
        $consulta = "DELETE FROM categoria WHERE Codigo_catego = $id";
        mysqli_query($conexion, $consulta);
        header("Location: ../views/usuarios/categorias.php");
        
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// INSERTAR PRODUCTOS
    function insertar_producto()
    {
        //Abrimos la conexion
        global $conexion;
        session_start();
        extract($_POST);
        $codigo=$_POST['codigo'];
        

        //$ejecutar=mysqli_query($conexion, $consulta);
        $ejecutar=mysqli_query($conexion, "SELECT * FROM productos WHERE Codigo_product=$codigo");
        if(mysqli_num_rows($ejecutar)>0)
        {
            //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al insertar el producto. ID existente';
        $_SESSION['message_type'] = 'danger';
        header('Location: ../views/usuarios/producto_agregar.php');
    exit();
        }else{
            
        //Datos correctos
       // Subir imagen segun lo requiera
       $seleccion = $_POST['seleccion'];
       if ($seleccion === 'no') 
           {
               $consulta="INSERT INTO productos(Codigo_product,Precio,Nombre_produc,Descripcion)
               VALUES ('$codigo','$precio','$nombre','$descripcion');" ;
   
   // Ejecuta el query 
   if($consulta)
   {
   //Todo correcto
   session_start();
   mysqli_query($conexion, $consulta);
   $_SESSION['message'] = 'Producto agregado Correctamente!';
   $_SESSION['message_type'] = 'success';
   // Guardar valores del formulario en la sesión
   $_SESSION['form_values'] = $_POST;
   header('Location: ../views/usuarios/index.php');
   exit();
   }
}
else
{
   
   
        //variables donde se almacenan los valores de nuestra imagen
   $tamanoArchvio=$_FILES['foto']['size'];
   //se realiza la lectura de la imagen
           $imagenSubida=fopen($_FILES['foto']['tmp_name'], 'r');
           $binariosImagen=fread($imagenSubida,$tamanoArchvio);   
   //se realiza la consulta correspondiente para guardar los datos
   $imagenFin =mysqli_escape_string($conexion,$binariosImagen);
  
   $consulta="INSERT INTO productos(Codigo_product,Precio,Nombre_produc,Descripcion,imagen)
   VALUES ('$codigo','$precio','$nombre','$descripcion','$imagenFin');" ;
   // Ejecuta el query de actualización
   if($consulta)
   {
   //Todo correcto
   session_start();
   mysqli_query($conexion, $consulta);
   $_SESSION['message'] = 'Producto agregado Correctamente!';
   $_SESSION['message_type'] = 'success';
   // Guardar valores del formulario en la sesión
   $_SESSION['form_values'] = $_POST;
   header('Location: ../views/usuarios/index.php');
   exit();
   }
}
         
        }
        
    }
    /// editar PRODUCTOS
    function editar_producto(){

        global $conexion;
        extract($_POST);
      
    
        
    
        // Subir imagen segun lo requiera
       $seleccion = $_POST['seleccion'];
       if ($seleccion === 'no') 
           {
            $consulta="UPDATE productos SET Nombre_produc='$nombre',
            Descripcion= '$descripcion',Precio=$precio WHERE Codigo_product = $id";
   
   // Ejecuta el query 
   if($consulta)
   {
   //Todo correcto
   session_start();
   mysqli_query($conexion, $consulta);
   $_SESSION['message'] = 'Actualizacion Correcta!';
   $_SESSION['message_type'] = 'success';
   // Guardar valores del formulario en la sesión
   $_SESSION['form_values'] = $_POST;
   header('Location: ../views/usuarios/index.php');
   exit();
   }
}
else
{
   
   
        //variables donde se almacenan los valores de nuestra imagen
   $tamanoArchvio=$_FILES['foto']['size'];
   //se realiza la lectura de la imagen
           $imagenSubida=fopen($_FILES['foto']['tmp_name'], 'r');
           $binariosImagen=fread($imagenSubida,$tamanoArchvio);   
   //se realiza la consulta correspondiente para guardar los datos
   $imagenFin =mysqli_escape_string($conexion,$binariosImagen);
  
   $consulta="UPDATE productos SET Nombre_produc='$nombre',
            Descripcion= '$descripcion',Precio=$precio, imagen='$imagenFin' WHERE Codigo_product = $id";
   // Ejecuta el query de actualización
   if($consulta)
   {
   //Todo correcto
   session_start();
   mysqli_query($conexion, $consulta);
   $_SESSION['message'] = 'Actualizacion correcta!';
   $_SESSION['message_type'] = 'success';
   // Guardar valores del formulario en la sesión
   $_SESSION['form_values'] = $_POST;
   header('Location: ../views/usuarios/index.php');
   exit();
   }
}
    
    }
    // ELIMINAR PRODUCTOS
    function eliminar_producto(){

        global $conexion;
        extract($_POST);
        session_start();
        $id = $_POST['id'];
        $consulta = "DELETE FROM productos WHERE Codigo_product = $id";
        if($consulta)
        {
        //Datos correctos
        mysqli_query($conexion, $consulta);
        
        $_SESSION['message'] = '¡Operación exitosa, Eliminado Correctamente!';
        $_SESSION['message_type'] = 'success';
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al Borrar,Intentelo de nuevo';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/index.php');
    exit();
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// INSERTAR PROVEEDOR
    function insertar_proveedor(){

        global $conexion;
        session_start();
        extract($_POST);

        $consulta="INSERT INTO proveedores(Nombre_prove,Descripción,Contacto,correo)
        VALUES ('$nombre','$descripcion','$contacto','$correo');" ;
    
    if($consulta)
    {
    //Datos correctos
    mysqli_query($conexion, $consulta);
    
    $_SESSION['message'] = '¡Operación exitosa, Proveedor Insertado!';
    $_SESSION['message_type'] = 'success';
    }else{
    //Algo sale mal
    $_SESSION['message'] = 'Hubo un error,Intentelo de nuevo';
    $_SESSION['message_type'] = 'danger';
    }
    header('Location: ../views/usuarios/proveedores.php');
exit();
    
    }
    /// editar PROVEEDOR
    function editar_proveedor(){

        global $conexion;
        session_start();
        extract($_POST);
    
    
        $consulta="UPDATE proveedores SET Nombre_prove='$nombre',Descripción= '$descripcion',Contacto='$contacto',contacto='$contacto' WHERE Codigo_provee = $id";
    
        if($consulta)
        {
        //Datos correctos
        mysqli_query($conexion, $consulta);
        
        $_SESSION['message'] = '¡Operación exitosa, Proveedor Actualizado!';
        $_SESSION['message_type'] = 'success';
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error,Intentelo de nuevo';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/proveedores.php');
    exit();
    
    }
    // ELIMINAR PROVEEDOR
    function eliminar_proveedor(){

        global $conexion;
        session_start();
        extract($_POST);
        $id = $_POST['id'];
        $consulta = "DELETE FROM proveedores WHERE Codigo_provee = $id";
        if($consulta)
    {
    //Datos correctos
    mysqli_query($conexion, $consulta);
    
    $_SESSION['message'] = '¡Operación exitosa, Proveedor Eliminado!';
    $_SESSION['message_type'] = 'success';
    }else{
    //Algo sale mal
    $_SESSION['message'] = 'Hubo un error,Intentelo de nuevo';
    $_SESSION['message_type'] = 'danger';
    }
    header('Location: ../views/usuarios/proveedores.php');
exit();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// INSERTAR CLIENTE
    function insertar_cliente(){

        global $conexion;
        session_start();
        extract($_POST);

        $consulta="INSERT INTO clientes(Nombre_clien,Region,Numero,correo)
        VALUES ('$nombre_cli','$region','$telefono','$correo');" ;
    
        if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa! Agregado Correctamente';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al insertar el Cliente.';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/agregar_cliente.php');
    exit();
        
    
    }
    /// editar CLIENTE
    function editar_cliente(){

        global $conexion;
        session_start();
        extract($_POST);
    
    
        $consulta="UPDATE clientes SET Nombre_clien='$nombre',Region='$region',Numero='$numero',correo='$correo' WHERE Codigo_client = $id";
        if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa!';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al actualizar el campo';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/clientes.php');
    exit();
    
    }
    // DESACTIVAR CLIENTE
    function desactivar_cliente(){

        global $conexion;
        session_start();
        extract($_POST);
        $id = $_POST['id'];
        $consulta = " UPDATE clientes SET estado = FALSE WHERE Codigo_client = $id;";
        if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa! Cliente Desactivado';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al desactivar el cliente';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/clientes.php');
    exit();
    }
    // ACTIVAR CLIENTE
    function activar_cliente(){

        global $conexion;
        session_start();
        extract($_POST);
        $id = $_POST['id'];
        $consulta = " UPDATE clientes SET estado = TRUE WHERE Codigo_client = $id;";
        if($consulta)
        {
         //Datos correctos
        mysqli_query($conexion, $consulta);
        $_SESSION['message'] = '¡Operación exitosa! Cliente Activado';
       $_SESSION['message_type'] = 'success';   
        }else{
        //Algo sale mal
        $_SESSION['message'] = 'Hubo un error al Activar el cliente';
        $_SESSION['message_type'] = 'danger';
        }
        header('Location: ../views/usuarios/clientes.php');
    exit();
    }
?>
