<?php

include '../../model/conexion_database.php';
date_default_timezone_set('America/Los_Angeles');

if(isset($_POST["opcion"]))
{
    $opcion = $_POST["opcion"];
    switch($opcion){
        case "insertar":
            extract($_POST);
            if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["cedula"])){

                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $cedula = $_POST["cedula"];
                $correo = "";
                $direccion = "";
                $material = "";
                $peso = "";
                $precio = "";
                $fecha = date("Y-m-d");

                if(isset($_POST["correo"])) $correo = $_POST["correo"] ;
                if(isset($_POST["direccion"])) $direccion = $_POST["direccion"] ;
                if(isset($_POST["material"])) $material = $_POST["material"] ;
                if(isset($_POST["peso"])) $peso = $_POST["peso"] ;
                if(isset($_POST["precio"])) $precio = $_POST["precio"] ;   
            }
            $sql = "INSERT INTO `usuario`(`id`, `cedula`, `nombre`, `apellido`, `correo`, `direccion`, `material`, `peso`, `precio`,`fecha_registro`) 
            VALUES ('','$cedula','$nombre','$apellido','$correo','$direccion','$material','$peso','$precio','$fecha')";
            $result = mysqli_query($con, $sql);
            break;

        case "eliminar":
            $eliminar = $_POST["idUsuario"];
            $sql = "DELETE FROM `usuario` WHERE `id`='$eliminar'";
            $resultado = mysqli_query($con, $sql);
            break;

        case "leer":
            $id = $_POST["id"];
            $sql = "SELECT user.id, user.cedula, user.nombre, user.apellido, user.correo, user.direccion, user.material as id_material, (SELECT material FROM precio_materiales WHERE precio_materiales.id = user.material) 
            as materiales, user.peso, user.precio FROM `usuario` as user where user.id = $id;";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);          
            echo json_encode($row);
            break;

        case "actualizar":
            if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["cedula"]) && isset($_POST["id"])){
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $cedula = $_POST["cedula"];
                $correo = "";
                $direccion = "";
                $material = "";
                $peso = "";
                $precio = "";
                $fecha = date("Y-m-d");

                if(isset($_POST["correo"])) $correo = $_POST["correo"] ;
                if(isset($_POST["direccion"])) $direccion = $_POST["direccion"] ;
                if(isset($_POST["material"])) $material = $_POST["material"] ;
                if(isset($_POST["peso"])) $peso = $_POST["peso"] ;
                if(isset($_POST["precio"])) $precio = $_POST["precio"] ;   
            }
            $sql = "UPDATE `usuario` 
            SET `cedula`='$cedula',
            `nombre`='$nombre',
            `apellido`='$apellido',
            `correo`='$correo',
            `direccion`='$direccion',
            `material`='$material',
            `peso`='$peso',
            `precio`='$precio' 
            `fecha_registro`=$fecha WHERE `id`= $id;";
            $result = mysqli_query($con, $sql);
            break;    

        default:
            echo "No se ha selecionado ninguna opcion";
            break;    
    }
    
}
