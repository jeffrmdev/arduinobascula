<?php
include '../../model/conexion_database.php';

$query = "SELECT * FROM `codigo_miembros`";
$result = mysqli_query($con, $query);

ob_start();
while ($row = mysqli_fetch_array($result)) {
    $datos[] = $array = array(
        'id' => $row[0],
        'codigo' => $row[1],
        'rol' => $row[2],
    );
}
echo json_encode($datos);

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

        case "eliminar":
            $eliminar = $_POST["id"];
            $sql = "DELETE FROM `codigo_miembros` WHERE id='$eliminar'";
            $result = mysqli_query($con, $sql);
        break;

        case "mostrar":
            ob_end_clean();
            $id = $_POST["id"];
            $sql = "SELECT id as id_detalles, codigo_miembro as codigo_detalles, rol_miembro as rol_detalles 
            FROM `codigo_miembros` WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);  
            ob_clean();        
            echo json_encode($row);
        break;

        case "actualizar":
            if(isset($_POST["rol"]) && isset($_POST["rol"])){
                $rol = $_POST["rol"];
                $codigo = $_POST["codigo"];
            }
            $id = $_POST["id"];
            $sql = "UPDATE `codigo_miembros` SET `codigo_miembro`='$codigo',`rol_miembro`='$rol' 
            WHERE id=$id";
            $result = mysqli_query($con, $sql);      
        break;
    }
}


