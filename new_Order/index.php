<!DOCTYPE html>
<html lang="es">

<head>
    <?php 
    session_start();

    //Imports
    include_once("./model/dao/common/Autenticacion.php");
    include_once("./model/services/common/Service_Autenticacion.php");
    include_once("./model/MySql/connection2.php");
    include_once("./model/entities/common/class_Usuario.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Estiles CSS-->
    <link rel="stylesheet" type="text/css" href="./css/common/general.css">
    <link rel="stylesheet" type="text/css" href="./css/common/login.css">
    <!--Nombre aplicacion-->
    <?php include_once("./vista/common/nameApp.html"); ?>
    <link rel="stylesheet" href="css/general/bootstrap.min.css">
</head>

<body>
    <?php 
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if (Autenticacion::autenticar($_POST['username'], $_POST['password'])) {
            $userClass = $_SESSION["usuarioClase"];
            
            /*switch ($userClass->tipo) {
                case 'alumno':
                    header("Location: ./vista/alumno/index.php");
                    break;
                case 'profesor':
                    header("Location: ./vista/profesor/index.php");
                    break;
    
                case 'administracion':
                    header("Location: ./vista/directivo/index.php");
                    break;
            }*/
        }else{
            header("Location: ./index.php?ER=2");
        }
    }
    ?>
    <div class="container">
        <form id="login-form" action="./index.php" method="post">
            <h2><img src="./resources/common/logo1.png" alt="" srcset=""></h2>
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <!--Scripts-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/common/login.js"></script>

    <script type="text/javascript">
        window.addEventListener("load", searchErrors);
    </script>
</body>

</html>