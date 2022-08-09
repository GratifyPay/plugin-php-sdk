<?php

namespace GratifyPay\PhpSdk\Request;

abstract class AbstractOrder {
    public const SHIPPING_METHOD_DELIVERY = 'DELIVERY';
    public const SHIPPING_METHOD_PICKUP = 'PICKUP';

    /**
     * @var string
     */
    public $storePlatform;

    /**
     * @var Item[]
     */
    public $items;

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
     * @param Item $item
     * @return self
     */
    public function setItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param string $shippingMethod
     * @return self
     */
    public function setShippingMethod(string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * @param float $priceSubTotal
     * @return self
     */
    public function setPriceSubTotal(float $priceSubTotal): self
    {
        $this->priceSubTotal = $priceSubTotal;

        return $this;
    }

    /**
     * @param float $shippingTotal
     * @return self
     */
    public function setShippingTotal(float $shippingTotal): self
    {
        $this->shippingTotal = $shippingTotal;

        return $this;
    }

    /**
     * @param float $taxesTotal
     * @return self
     */
    public function setTaxesTotal(float $taxesTotal): self
    {
        $this->taxesTotal = $taxesTotal;

        return $this;
    }

    /**
     * @param string $storePlatform
     * @return self
     */
    public function setStorePlatform(string $storePlatform): self
    {
        $this->storePlatform = $storePlatform;

        return $this;
    }
}
