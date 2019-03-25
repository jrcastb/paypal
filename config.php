<?php

require 'paypal/autoload.php';
define('URL_SITIO', 'http://localhost/paypal/');
//instalar sdk en mi aplicacion
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        //cliente ID
        'AYqn7YpMPA4ljf-Huyg-twPSXNuCGJ6hIE9Hlfz88SDzLm5vzG-2SBP86bXt7D1wQguJ06WtNBqvWc7r',
        //Secret
        'EPltg_4vj9XMVELPPOGMPhIoi60G_2Wr5u7BWXuVQgVUp_Ug1GnFgnW7RxFQu615scfwUJ81ivj0ccmJ'
    )
);

