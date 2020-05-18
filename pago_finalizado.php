<?php include_once 'includes/templates/header.php' 

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;
require 'includes/paypal.php';
?>

<section class="seccion contenedor">
    <h2>Pagos con Paypal</h2>
        <?php
            if(isset($_GET['id_pago'])) {

                $paymentId = $_GET['paymentId'];
                $id_pago = (int) $_GET['id_pago'];

                // Peticion a Rest Api
                $pago = Payment::get($paymentId, $apiContext);
                $execution = new PaymentExecution();
                $execution->setPayerId( $_GET['PayerID'] );

                $resultado = $pago->execute($execution, $apiContext);

                $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;
            
                if($respuesta == "completed") {
                    echo "<div class='resultado correcto'>";
                    echo "El pago se realizó correctamente";
                    echo "El ID del pago es: {$id_pago}";
                    echo "</div>";

                    include_once('includes/funciones/bd_conexion.php');
                    $stmt = $conn->prepare('UPDATE registrados SET pagado = ? WHERE id_registrado = ? ');
                    $pagado = 1;
                    $stmt->bind_param('ii', $pagado, $id_pago);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                }else {
                    echo "<div class='resultado error'>";
                    echo "El pago no se realizó";
                    echo "</div>";
                }
            }
        ?>
</section>

<?php include_once 'includes/templates/footer.php' ?>