<?php

namespace GratifyPay\PhpSdk;

class Address
{   

    /**
     * @var string
     */
    public $name;
    
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
     * @param string $name
     * @return Address
     */
    public function setName(string $name): Address
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @param string $line1
     * @return Address
     */
    public function setLine1(string $line1): Address
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * @param string $line2
     * @return Address
     */
    public function setLine2(string $line2): Address
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $state
     * @return Address
     */
    public function setState(string $state): Address
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $postcode
     * @return Address
     */
    public function setPostcode(string $postcode): Address
    {
        $this->postcode = $postcode;

        return $this;
    }
}
