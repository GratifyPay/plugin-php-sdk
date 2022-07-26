<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use GratifyPay\PhpSdk\Client;
use GratifyPay\PhpSdk\Request\Item;
use GratifyPay\PhpSdk\Request\OrderInitialize;
use GratifyPay\PhpSdk\Address as ShippingAddress;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE
    );

    $shippingAddress = new ShippingAddress();
    $shippingAddress->setCity('Brampton')
        ->setCountry('CA')
        ->setLine1('8 Automatic Rd #30')
        ->setState('ON')
        ->setPostcode('L6S 5N4');

    $order = new OrderInitialize();
    $order->setReturnURL('https://example.com/return/link')
        ->setCallbackURL('https://example.com/callback/link')
        ->setFailureURL('https://example.com/failure/url')
        ->setShippingMethod(OrderInitialize::SHIPPING_METHOD)
        ->setShippingAddress($shippingAddress)
        ->setStorePlatform('PRESTASHOP')
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

    $paymentSchedule = $client->orderInitialize($order);
    print_r($paymentSchedule);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
