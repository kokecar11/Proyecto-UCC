<?php
    require_once "./core/configGeneral.php";

?>

<!DOCTYPE html>
<html lang="es">  
<head>
	<title>Recuperar Contraseña</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURLL;?>vistas/css/main.css">
</head>
<body>
    <div class="full-box login-container cover">
        <form action="<?php echo SERVERURLL;?>" method="" autocomplete="off" class="logInForm">        
                <p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
                <p class="text-center text-muted text-uppercase">Recuperar Contraseña.</p>
                <div class="form-group label-floating">
                    <label class="control-label" for="UserName">Correo Institucional*</label>
                    <input class="form-control" id="UserName" type="text">
                    <p class="help-block">Escribe tú Correo Institucional</p>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Recuperar" class="btn btn-info" style="color: #FFF;">
                </div>
        </form> 
    </div>
    <?php include "./vistas/modulos/script.php"; ?>
</body>
</html>