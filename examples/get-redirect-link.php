<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/env.php';

use GratifyPay\PhpSdk\Client;
use GratifyPay\PhpSdk\Request\Item;
use GratifyPay\PhpSdk\Request\OrderInitialize;
use GratifyPay\PhpSdk\Request\ShippingAddress;

try {
    $client = new Client(
        MERCHANT_ID,
        SECRET_KEY,
        IS_LIVE,
        IS_US
    );

    $shippingAddress = new ShippingAddress();
    $shippingAddress->setCity('city')
        ->setCountry('USA')
        ->setLine1('Street address 123')
        ->setState('New York')
        ->setPostcode('10001');

    $order = new OrderInitialize();
    $order->setReturnURL('https://example.com/return/link')
        ->setCallbackURL('https://example.com/callback/link')
        ->setFailureURL('https://example.com/failed/link')
        ->setMerchantReference(123)
        ->setStorePlatform('PRESTASHOP')
        ->setShippingMethod(OrderInitialize::SHIPPING_METHOD)
        ->setShippingAddress($shippingAddress)
        ->setPriceSubTotal(100)
        ->setShippingTotal(10)
        ->setTaxesTotal(10);

    $item1 = new Item();
    $item1->setId(123)
        ->setPrice(25)
        ->setTotalPrice(50)
        ->setQuantity(2)
        ->setImageURL('/link/to/image1')
        ->setTitle('Test product 1');
    $order->setItem($item1);

    $item2 = new Item();
    $item2->setId(123)
        ->setPrice(25)
        ->setTotalPrice(50)
        ->setQuantity(2)
        ->setImageURL('/link/to/image2')
        ->setTitle('Test product 1');
    $order->setItem($item2);

    $initializedOrder = $client->orderInitialize($order);
    $redirectLink = $client->getRedirectLink($initializedOrder->getOrderMapId());
    print_r($redirectLink);

} catch (\Exception $e) {
    print_r($e->getMessage());
}
