<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use Gratify\PhpSdk\Client;
use Gratify\PhpSdk\Request\Item;
use Gratify\PhpSdk\Request\OrderInitialize;
use Gratify\PhpSdk\Request\Refund;
use Gratify\PhpSdk\Request\ShippingAddress;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE,
        IS_US
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
