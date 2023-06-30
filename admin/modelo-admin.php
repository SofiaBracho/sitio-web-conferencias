<?php
include_once 'funciones/funciones.php';

if(isset($_POST['registro']) ) {
    if($_POST['registro'] == 'nuevo' ) {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $nivel = (int) $_POST['nivel'];
        $password = $_POST['password'];
        $opciones = array(
            'cost' => 12
        );
    
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
    
        try {
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password, nivel) VALUES (?, ?, ?, ?) ");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $nivel);
            $stmt->execute();
            $admin_id = $stmt->insert_id;
    
            if($stmt->affected_rows && $admin_id != 0) {
                $respuesta = array(
                    'admin_id' => $admin_id,
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
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $id_registro = $_POST['id_registro'];
        $opciones = array(
            'cost' => 12
        );
        try {
            if(empty($password) ) {
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ? ");
                $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);
            } else {
                $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ? ");
                $stmt->bind_param("sssi", $usuario, $nombre, $hash_password, $id_registro);
            }
            $stmt->execute();

            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $id_registro
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
            
            $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ? ");
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
}

?>