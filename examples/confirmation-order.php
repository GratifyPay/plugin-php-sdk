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

    $paymentSchedule = $client->confirmationOrder('order_2cN6Pq7zca7skDtV5HInRl', '111', 'PRESTASHOP');
    print_r($paymentSchedule);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
