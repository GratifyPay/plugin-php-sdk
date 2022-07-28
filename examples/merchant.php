<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use GratifyPay\PhpSdk\Client;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE
    );

    $merchant = $client->getMerchant();
    print_r($merchant);

} catch (\Exception $e) {
    print_r($e->getMessage());
}

