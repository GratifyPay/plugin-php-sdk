<?php

namespace GratifyPay\PhpSdk\Request;

use GratifyPay\PhpSdk\Request\AbstractOrder;
use GratifyPay\PhpSdk\Address as ShippingAddress;

class InitOrder extends AbstractOrder {

    /**
     * @var ShippingAddress
     */
    public $shippingAddress;

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
    public $merchantReference;

    /**
     * @param ShippingAddress $shippingAddress
     * @return self
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @param $returnURL
     * @return self
     */
    public function setReturnURL($returnURL): self
    {
        $this->returnURL = $returnURL;

        return $this;
    }

    /**
     * @param string $callbackURL
     * @return self
     */
    public function setCallbackURL(string $callbackURL): self
    {
        $this->callbackURL = $callbackURL;

        return $this;
    }

    /**
     * @param string $failureURL
     * @return self
     */
    public function setFailureURL(string $failureURL): self
    {
        $this->failureURL = $failureURL;

        return $this;
    }

    /**
     * @param string $merchantReference
     * @return self
     */
    public function setMerchantReference(string $merchantReference): self
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }
}
