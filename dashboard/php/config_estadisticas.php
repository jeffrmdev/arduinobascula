<?php
include '../../model/conexion_database.php';

$year = $_POST['year'];

$query = "SELECT COUNT(*) AS cantidad , (MONTH(`fecha_registro`)) AS mes , (YEAR(`fecha_registro`)) AS year
FROM `usuario`
WHERE (YEAR(`fecha_registro`)) = $year
GROUP BY MONTH(`fecha_registro`)
ORDER BY MONTH(`fecha_registro`) ASC;";


$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    $datos[] = $array = array(
        'cantidad' => $row[0],
        'mes' => $row[1],
        'year' => $row[2],
    );
}

echo json_encode($datos);


