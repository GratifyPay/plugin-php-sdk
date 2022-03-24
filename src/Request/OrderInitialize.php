<?php

namespace GratifyPay\PhpSdk\Request;

class OrderInitialize
{
    /**
     * @var string
     */
    public $returnURL;

    /**
     * @var string
     */
    public $callbackURL;

    /**
     * @var string
     */
    public $failureURL;

    /**
     * @var string
     */
    public $storePlatform;

    /**
     * @var Item[]
     */
    public $items;

    /**
     * @var ShippingAddress
     */
    public $shippingAddress;

    /**
     * @var string
     */
    public $shippingMethod;

    /**
     * @var float
     */
    public $priceSubTotal;

    /**
     * @var float
     */
    public $shippingTotal;

    /**
     * @var float
     */
    public $taxesTotal;

    /**
     * @var string
     */
    public $merchantReference;

    public const SHIPPING_METHOD = 'DELIVERY';

    /**
     * @param $returnURL
     * @return OrderInitialize
     */
    public function setReturnURL($returnURL): OrderInitialize
    {
        $this->returnURL = $returnURL;

        return $this;
    }

    /**
     * @param Item $item
     * @return OrderInitialize
     */
    public function setItem(Item $item): OrderInitialize
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param ShippingAddress $shippingAddress
     * @return OrderInitialize
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): OrderInitialize
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @param string $shippingMethod
     * @return OrderInitialize
     */
    public function setShippingMethod(string $shippingMethod): OrderInitialize
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * @param float $priceSubTotal
     * @return OrderInitialize
     */
    public function setPriceSubTotal(float $priceSubTotal): OrderInitialize
    {
        $this->priceSubTotal = $priceSubTotal;

        return $this;
    }

    /**
     * @param float $shippingTotal
     * @return OrderInitialize
     */
    public function setShippingTotal(float $shippingTotal): OrderInitialize
    {
        $this->shippingTotal = $shippingTotal;

        return $this;
    }

    /**
     * @param float $taxesTotal
     * @return OrderInitialize
     */
    public function setTaxesTotal(float $taxesTotal): OrderInitialize
    {
        $this->taxesTotal = $taxesTotal;

        return $this;
    }

    /**
     * @param string $callbackURL
     * @return OrderInitialize
     */
    public function setCallbackURL(string $callbackURL): self
    {
        $this->callbackURL = $callbackURL;

        return $this;
    }

    /**
     * @param string $failureURL
     * @return OrderInitialize
     */
    public function setFailureURL(string $failureURL): self
    {
        $this->failureURL = $failureURL;

        return $this;
    }

    /**
     * @param string $storePlatform
     * @return OrderInitialize
     */
    public function setStorePlatform(string $storePlatform): self
    {
        $this->storePlatform = $storePlatform;

        return $this;
    }

    /**
     * @param string $merchantReference
     * @return OrderInitialize
     */
    public function setMerchantReference(string $merchantReference): self
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }
}
