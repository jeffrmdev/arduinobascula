<?php

include '../model/conexion_database.php';

//ENCRIPTACION
include 'SED.php';

//VALIDACION DE DATOS BD
$val_code = false;
$val_user = true;
$val_email = true;

$name = '';
$lastname = '';
$email = '';
$username = '';
$code = '';
$pass = '';

$mens_error = '';

if (
    !empty($_POST['name']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['email']) &&
    !empty($_POST['username']) &&
    !empty($_POST['code']) &&
    !empty($_POST['password'])
) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $code = $_POST['code'];
    $pass = $_POST['password'];

    $password = SED::encryption($pass);

    $buscar = "SELECT `codigo_miembro`, `id` FROM `codigo_miembros` WHERE `codigo_miembro` = '$code'";
    $result = mysqli_query($con, $buscar);

    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $db_code = $row[0];
            $id_code = $row[1];

            if ($db_code == $code) {
                $val_code = true;
            }
        }
    }

    if (!$val_code) {
        $mens_error = '<div class="alert alert-warning" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>
                                El <strong>código de rol</strong> no es correcto o no existe.
                                </div>';
    }

    if ($val_code) {
        $buscar = "SELECT `username_usuario`,`correo_usuario` FROM `login_usuarios` 
                WHERE `username_usuario` = '$username' OR `correo_usuario` = '$email'";
        $result = mysqli_query($con, $buscar);

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $db_user = $row[0];
                $db_email = $row[1];

                if ($db_user == $username) {
                    $val_user = false;
                }
                if ($db_email == $email) {
                    $val_email = false;
                }
            }
        }

        if (!$val_user) {
            $mens_error = '<div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            El <strong>nombre de usuario</strong> que ha escogido ya está registrado.
                            </div>';
        }

        if (!$val_email) {
            $mens_error = '<div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            El <strong>correo</strong> que ha colocado ya está registrado.
                            </div>';
        }

        if ($val_user && $val_email) {
            $insert = "INSERT INTO `login_usuarios`(`id_usuario`, `username_usuario`, `nombre_usuario`, `apellido_usuario`, `id_codigo_miembro`, `correo_usuario`, `password_usuario`) 
                        VALUES (null,'$username','$name','$lastname','$id_code','$email','$password')";

            $registrar = mysqli_query($con, $insert);

            $mens_error = '<div class="alert alert-success" role="alert" id="reset">
                            Se ha registado exitosamente, 
                            <a href="./login.php" class="alert-link">iniciar sesión</a>.
                            </div>';
        }
    }

    /*  $mens_error = '<div class="alert alert-success" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> Se ha registado exitosamente, 
                            <a href="#" class="alert-link">iniciar sesión</a>.
                            </div>';*/
} else {
    $mens_error = '<div class="alert alert-danger" id="bd-validar" role="alert">
            <i class="fas fa-exclamation-triangle"></i>Complete el formulario
            </div>';
}

echo $mens_error;

?>