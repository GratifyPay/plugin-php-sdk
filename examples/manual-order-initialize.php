<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use GratifyPay\PhpSdk\Client;
use GratifyPay\PhpSdk\Request\Item;
use GratifyPay\PhpSdk\Request\InitManualOrder;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE
    );

    $order = new InitManualOrder();
    $order->setShippingMethod(InitOrder::SHIPPING_METHOD_PICKUP)
        ->setStorePlatform('WOOCOMMERCE')
        ->setMerchantReference(111)
        ->setPriceSubTotal(100)
        ->setShippingTotal(10)
        ->setTaxesTotal(10);

    $item1 = new Item();
    $item1->setId(123)
        ->setPrice(25)
        ->setTotalPrice(50)
        ->setQuantity(2)
        ->setImageURL('/path/to/image1')
        ->setTitle('Test product 1');
    $order->setItem($item1);

    $item2 = new Item();
    $item2->setId(124)
        ->setPrice(25)
        ->setTotalPrice(50)
        ->setQuantity(2)
        ->setImageURL('/path/to/image2')
        ->setTitle('Test product 1');
    $order->setItem($item2);

    $order_token = $client->manualOrderInitialize($order);
    print_r($order_token);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
