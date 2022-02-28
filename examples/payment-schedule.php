<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use Gratify\PhpSdk\Client;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE,
        IS_US
    );

    $paymentSchedule = $client->getPaymentsSchedule(100);
    print_r($paymentSchedule);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
