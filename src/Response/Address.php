<?php

namespace GratifyPay\PhpSdk\Response;

class Address
{
    /**
     * @var string
     */
    protected $line1;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->line1 = $fields['line1'] ?? null;
        $this->country = $fields['country'] ?? null;
        $this->city = $fields['city'] ?? null;
        $this->state = $fields['state'] ?? null;
        $this->postcode = $fields['postcode'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
}
