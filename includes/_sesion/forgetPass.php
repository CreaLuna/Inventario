<?php
require_once ("../_db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('../../img/fondo.jpg'); /* imagen de  fondo */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .btn-container {
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }
        .confirm-btn {
            background-color: #4CAF50;
            color: white;
        }
        .cancel-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Su contrasena sera reestablecida a la que se entrego</h1>
        <p>si usted esta de acuerdo presione en confirmar.</p>
        <div class="btn-container">
            <button class="btn confirm-btn" onclick="newPass()">Confirmar</button>
            <a href="login.php"><button class="btn cancel-btn">Cancelar</button></a>

            <p>si tiene dudas o problemas comuniquese al 10101010.</p>
        </div>
    </div>
</body>
</html>


<script>
        function newPass() {
            if (confirm('¿Estás seguro de que deseas realizar cambios?')) {
                
                fetch('pass.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cambios Correctos');
                        window.location.href = '../../index.php'; // Redirige al inicio de sesión.
                    } else {
                        alert('Error al realizar cambios en la base de datos');
                    }
                })
                .catch(error => {
                    alert('Error en la solicitud AJAX: ' + error);
                });
            }
        }
    </script>

