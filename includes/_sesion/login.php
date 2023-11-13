
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
        .alert {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d4d4d4;
            border-radius: 5px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
   
<form  action="validar.php" method="POST" autocomplete="off">
<div id="login" >
        <div class="container">
        <CENter><h1>BIENVENIDO, POR FAVOR INGRESE SUS DATOS</h1></CENter> 
        <?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';

    // Una vez que se muestra el mensaje, debes eliminarlo para que no se muestre de nuevo
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center">USUARIO</h3>

                            <div class="form-group">
                                <label for="user">Usuario:</label><br>
                                <input type="text" name="user" id="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                             <br>
                                <input type="submit"class="btn btn-success btn-md space" value="ingresar">
                                <div id="register-link" class="text-right">
                                    
                                    <br>
                                <!-- <a href="registros.php"><input type="button"  class="btn btn-primary space" value="registrarse"></a> -->
                                <br>
                                <a href="forgetPass.php"><input type="button"  class="btn btn-warning space" value="Reestablecer"></a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>