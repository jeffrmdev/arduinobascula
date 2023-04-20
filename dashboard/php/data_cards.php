<?php 

include '../../model/conexion_database.php';


#NUMERO TOTAL DE USUARIOS REGISTRADOS
$sql = "SELECT COUNT(`id`) FROM `usuario`";
$fila1 = mysqli_fetch_row(mysqli_query($con, $sql));


#MATERIAL MAS RECICLADO
$sql = "SELECT p.material, COUNT(u.material)
FROM precio_materiales AS p, usuario as u WHERE p.id = (
SELECT material
FROM  usuario
GROUP BY material
ORDER BY count(material) DESC LIMIT 1) 
AND u.material = (
SELECT material
FROM  usuario
GROUP BY material
ORDER BY count(material) DESC LIMIT 1)";
$fila2 = mysqli_fetch_row(mysqli_query($con, $sql));

#PESO TOTAL DE MATERIAL RECICLADO
$sql = "SELECT SUM(`peso`) FROM `usuario`";
$fila3 = mysqli_fetch_row(mysqli_query($con, $sql));
$peso = $fila3[0];
$medida = 'g';


#Validar datos
if($fila3[0] > 1000){
    $peso = $fila3[0]/1000;
    $medida = "Kg";
}

if($fila2[0] == null) $fila2[0] = "Ninguno";

#IMPRIMIR EL ARRAY
$datos[] = array(
    'Total de clientes registrados'=> $fila1[0],
    'Material más reciclado' => $fila2[0],
    'Cantidad reciclada' => ($peso+0 . " " . $medida)
);

echo json_encode($datos);