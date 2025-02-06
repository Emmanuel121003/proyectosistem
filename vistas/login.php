<?php
session_start();
require_once "../config/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['logina']) && !empty($_POST['clavea'])) {
        $usuario = trim($_POST['logina']);
        $clave = trim($_POST['clavea']);
        $clavehash = hash("SHA256", $clave); // 🔹 Aplicamos SHA256 a la clave ingresada

        $stmt = $conexion->prepare("SELECT usuario_id FROM usuario WHERE login = ? AND clave = ? LIMIT 1");
        $stmt->bind_param("ss", $usuario, $clavehash);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($idusuario);
            $stmt->fetch();

            $_SESSION["usuario_id"] = $idusuario;
            $_SESSION["usuario"] = $usuario;
            header("Location: usuario.php");
            exit();
        } else {
            $mensaje_error = "Usuario o contraseña incorrectos.";
        }
        $stmt->close();
    } else {
        $mensaje_error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TI - Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#">Sistema</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos de acceso</p>

        <?php if (isset($mensaje_error)): ?>
            <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" name="logina" class="form-control" placeholder="Usuario" required>
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="clavea" class="form-control" placeholder="Contraseña" required>
                <span class="fa fa-key form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
            </div>
        </form>

        <a href="#">Olvidé mi contraseña</a>
    </div>
</div>

<script src="../public/js/jquery-3.1.1.min.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
<script src="../public/js/bootbox.min.js"></script>

</body>
</html>
