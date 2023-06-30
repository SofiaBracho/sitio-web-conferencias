<?php

function usuario_autenticado() {
    if(!revisar_usuario() ) {
        header('Location:login.php');
        exit();
    }
}

function revisar_usuario() {
    return isset($_SESSION['usuario']);
}

function comprobar_nivel() {
    if($_SESSION['nivel'] != 1) {
        header('Location:admin-area.php');
    }
}

session_start();
usuario_autenticado();