<?php
include '../../model/conexion_database.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$username = $_POST["username"];

$query = "UPDATE `login_usuarios` SET 
`username_usuario`='$username',
`nombre_usuario`='$nombre',
`apellido_usuario`='$apellido',
`correo_usuario`='$correo'
WHERE `id_usuario`=$id";
$result = mysqli_query($con, $query);


$_SESSION['id'] = $id;
$_SESSION['nombre'] = $nombre; 
$_SESSION['apellido'] = $apellido; 

echo "Se han realizado los cambios";