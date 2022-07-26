<?php

namespace GratifyPay\PhpSdk\Response;

use GratifyPay\PhpSdk\Address;
use GratifyPay\PhpSdk\Response\SettlementDetails;

class Merchant
{
    /**
     * @var string|null
     */
    protected $id;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $email;
    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var int|null
     */
    protected $weekDelta;
    /**
     * @var int|null
     */
    protected $numPayments;
    /**
     * @var int|null
     */
    protected $minAmount;
    /**
     * @var int|null
     */
    protected $maxAmount;
    /**
     * @var SettlementDetails
     */
    protected $settlementDetails;
    /**
     * @var string|null
     */
    protected $merchantState;
    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->id = $fields['id'] ?? null;
        $this->name = $fields['name'] ?? null;
        $this->email = $fields['email'] ?? null;
        $this->phone = $fields['phone'] ?? null;

        if (isset($fields['address'])) {
            $this->address = new Address($fields['address']);
        }

        $this->weekDelta = $fields['weekDelta'] ?? null;
        $this->numPayments = $fields['numPayments'] ?? null;
        $this->minAmount = $fields['minAmount'] ?? null;
        $this->maxAmount = $fields['maxAmount'] ?? null;

        if (isset($fields['settlementDetails'])) {
            $this->settlementDetails = new SettlementDetails($fields['settlementDetails']);
        }

        $this->merchantState = $fields['merchantState'] ?? null;
        $this->currency = $fields['currency'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @return int|null
     */
    public function getWeekDelta()
    {
        return $this->weekDelta;
    }

    /**
     * @return int|null
     */
    public function getNumPayments()
    {
        return $this->numPayments;
    }

    /**
     * @return int|null
     */
    public function getMinAmount()
    {
        return $this->minAmount;
    }

    /**
     * @return int|null
     */
    public function getMaxAmount()
    {
        return $this->maxAmount;
    }

    /**
     * @return SettlementDetails
     */
    public function getSettlementDetails(): ?SettlementDetails
    {
        return $this->settlementDetails;
    }

    /**
     * @return string|null
     */
    public function getMerchantState()
    {
        return $this->merchantState;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}