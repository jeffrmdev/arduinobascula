<?php

include '../model/conexion_database.php';
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$cedula = $_POST["cedula"];
$correo = $_POST["correo"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];
$pre = $_POST["precio_total"]; 
$pso = $_POST["peso"];


$material = explode('_', $_POST["material"]);
$pre = explode(" ", $_POST["precio_total"]);
$pso = explode(" ", $_POST["peso"]);

$peso = $pso[0];
$precio = $pre[0];
$material_id = $material[0];

$insert = "INSERT INTO usuario (id, cedula, nombre, apellido, correo, direccion, material, peso, precio) VALUES (null, '$cedula','$nombre','$apellido','$correo','$direccion','$material_id','$peso','$precio')";

$result = mysqli_query($con, $insert);

ob_end_clean();

header("location: ../");