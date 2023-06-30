<?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';

    $sql = "SELECT fecha_registro, COUNT(*) AS resultado FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro LIMIT 10";
    $resultado = $conn->query($sql);

    $registros = array();
    while($registro_dia = $resultado->fetch_assoc()) {
        $fecha = $registro_dia['fecha_registro'];

        $registros['fecha'][] = date('Y-m-d', strtotime($fecha));
        $registros['cantidad'][] = $registro_dia['resultado'];
    }
    

    echo json_encode($registros);