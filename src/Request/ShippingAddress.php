<?php

namespace GratifyPay\PhpSdk\Request;

class ShippingAddress
{
    /**
     * @var string
     */
    public $line1;

    /**
     * @var string
     */
    public $line2;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $postcode;

    /**
     * @param string $line1
     * @return ShippingAddress
     */
    public function setLine1(string $line1): ShippingAddress
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * @param string $line2
     * @return ShippingAddress
     */
    public function setLine2(string $line2): ShippingAddress
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * @param string $country
     * @return ShippingAddress
     */
    public function setCountry(string $country): ShippingAddress
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $city
     * @return ShippingAddress
     */
    public function setCity(string $city): ShippingAddress
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $state
     * @return ShippingAddress
     */
    public function setState(string $state): ShippingAddress
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $postcode
     * @return ShippingAddress
     */
    public function setPostcode(string $postcode): ShippingAddress
    {
        $this->postcode = $postcode;

        return $this;
    }
}
