<?php

require 'paypal/autoload.php';

define('URL_SITIO', 'http://localhost/Sofia/Sitio%20web%20de%20conferencias/');

$apiContext = new \PayPal\Rest\ApiContext(
    new PayPal\Auth\OAuthTokenCredential(
        // Cliente ID
        '34526ffjh4g',
        // Secret
        '34526ffjh4g'
    )
);