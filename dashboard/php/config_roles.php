<?php
include '../../model/conexion_database.php';

$query = "SELECT * FROM `codigo_miembros`";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    $datos[] = $array = array(
        'id' => $row[0],
        'codigo' => $row[1],
        'rol' => $row[2],
    );
}

if(isset($_POST["opcion"]))
{
    $opcion = $_POST["opcion"];
    switch($opcion){
        case "agregar":
            if(isset($_POST["rol"]) && isset($_POST["rol"])){
                $rol = $_POST["rol"];
                $codigo = $_POST["codigo"];
            }
            $sql = "INSERT INTO `codigo_miembros`(`id`, `codigo_miembro`, `rol_miembro`)
            VALUES ('','$codigo','$rol')";
            $result = mysqli_query($con, $sql);
        break;
    }
}

echo json_encode($datos);

