<?php

namespace GratifyPay\PhpSdk\Response;

class SettlementDetails
{
    /**
     * @var string
     */
    protected $accountNumber;

    /**
     * @var string
     */
    protected $accountType;

    /**
     * @var string
     */
    protected $routingNumber;

    /**
     * @var string
     */
    protected $entityType;

    /**
     * @var string
     */
    protected $nameOnAccount;

    /**
     * @var bool
     */
    protected $isVerified;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->accountNumber = $fields['accountNumber'] ?? null;
        $this->accountType = $fields['accountType'] ?? null;
        $this->routingNumber = $fields['routingNumber'] ?? null;
        $this->entityType = $fields['entityType'] ?? null;
        $this->nameOnAccount = $fields['nameOnAccount'] ?? null;
        $this->isVerified = $fields['isVerified'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @return mixed
     */
    public function getCccountType()
    {
        return $this->accountType;
    }

    /**
     * @return mixed
     */
    public function getRoutingNumber()
    {
        return $this->routingNumber;
    }

    /**
     * @return mixed
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @return mixed
     */
    public function getNameOnAccount()
    {
        return $this->nameOnAccount;
    }

    /**
     * @return bool
     */
    public function IsVerified()
    {
        return $this->isVerified;
    }
}
