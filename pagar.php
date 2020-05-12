<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/paypal.php';

if( !isset($_POST['submit']) ) {
    exit("Hubo un error");
}

if( isset($_POST['submit']) ) {
    
    //Datos del usuario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pagar'];
    $fecha = date('Y-m-d H:i:s');

    //PRODUCTOS
    $boletos = $_POST['boletos'];
    $numero_boletos = $boletos;
    $extras = $_POST['pedido_extras'];
    $camisas = $_POST['pedido_extras']['camisas']['cantidad'];
    $precioCamisas = $_POST['pedido_extras']['camisas']['precio'];
    $etiquetas = $_POST['pedido_extras']['etiquetas']['cantidad'];
    $precioEtiquetas = $_POST['pedido_extras']['etiquetas']['precio'];

    include_once 'includes/funciones/funciones.php';
    $pedido = productos_json($boletos, $camisas, $etiquetas);

    //EVENTOS
    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);

    //Creando el registro en la BD
    try {
        require_once('includes/funciones/bd_conexion.php');
            
        $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
        $stmt->execute();
        $ID_registro = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        // header('Location: validar_registro.php?exitoso=1');
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    //Haciendo compra con PayPal
    $compra = new Payer();
    $compra->setPaymentMethod('paypal');
 
    $i=0;
    $arreglo_pedido = array();
    foreach ($numero_boletos as $key => $value) {
        if( (int) $value['cantidad'] > 0) {
            ${"articulo$i"} = new Item();
            $arreglo_pedido[] = ${"articulo$i"};
            ${"articulo$i"}->setName("Pase: " . $key)
                        ->setCurrency('USD')
                        ->setQuantity($value['cantidad'])
                        ->setPrice($value['precio']);

            $i++;
        }
    }
    foreach ($extras as $key => $value) {
        if($key == 'camisas') {
            $precio = (float) $value['precio'] * .97;
        }
        else {
            $precio = (float) $value['precio'];
        }

        if( (int) $value['cantidad'] > 0) {
            ${"extra$i"} = new Item();
            $arreglo_pedido[] = ${"extra$i"};
            ${"extra$i"}->setName("Extra: " . $key)
                        ->setCurrency('USD')
                        ->setQuantity($value['cantidad'])
                        ->setPrice($precio);
            $i++;
        }
    }

    $listaArticulos = new ItemList();
    $listaArticulos->setItems($arreglo_pedido);

    /* Solo especificar si vas a usar envios
    $detalles = new Details();
    $detalles->setShipping($envio)
            ->setSubTotal($precio); */

    $cantidad = new Amount();
    $cantidad->setCurrency('USD')
            ->setTotal($total);

    $transaccion = new Transaction();
    $transaccion->setAmount($cantidad)
                ->setItemList($listaArticulos)
                ->setDescription('Pago GDLWebCamp')
                ->setInvoiceNumber($ID_registro);

    $redireccionar = new RedirectUrls();
    $redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$ID_registro}")
                ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$ID_registro}");

    $pago = new Payment();
    $pago->setIntent("sale")
        ->setPayer($compra)
        ->setRedirectUrls($redireccionar)
        ->setTransactions(array($transaccion));

    try {
        $pago->create($apiContext);
    } catch (PayPal\Exception\PayPalConnectionException $pce) {
        echo "<pre>";
            print_r(json_decode($pce->getData()));
            exit;
        echo "</pre>";
    }

    $aprobado = $pago->getApprovalLink();

    header("Location: {$aprobado}");
}