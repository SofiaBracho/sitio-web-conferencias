<?php
include_once 'funciones/funciones.php';

if($_POST['registro'] == 'nuevo' ) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_extras']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extras']['etiquetas']['cantidad'];
    $pedido = productos_json($boletos, $camisas, $etiquetas);

    $total = $_POST['total_pagar'];
    $regalo = $_POST['regalo'];

    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos);

    try {
        $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
        $stmt->bind_param("sssssis", $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        $registro_id = $stmt->insert_id;

        if($stmt->affected_rows) {
            $respuesta = array(
                'id_insertado' => $registro_id,
                'respuesta' => 'exito'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar' ) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_extras']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extras']['etiquetas']['cantidad'];
    $pedido = productos_json($boletos, $camisas, $etiquetas);

    $total = $_POST['total_pagar'];
    $regalo = $_POST['regalo'];

    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos);

    $id_registrado = $_POST['id_registrado'];
    $fecha_registro = $_POST['fecha_registro'];
    
    try {
        $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, fecha_registro = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, pagado = 1 WHERE id_registrado = ? ");
        $stmt->bind_param("ssssssisi", $nombre, $apellido, $email, $fecha_registro, $pedido, $registro_eventos, $regalo, $total, $id_registrado);
        $stmt->execute();

        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registrado
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar' ) {
    $id = (int) $_POST['id'];
    
    try {
        
        $stmt = $conn->prepare("DELETE FROM registrados WHERE id_registrado = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}


?>