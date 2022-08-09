<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use GratifyPay\PhpSdk\Client;
use GratifyPay\PhpSdk\Request\Refund;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE
    );

    $refund = new Refund();
    $refund->setMerchantRefundId(123)
        ->setOrderId(123)
        ->setAmount(100);
    $paymentSchedule = $client->orderRefund($refund);
    print_r($paymentSchedule);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
