<?php

namespace GratifyPay\PhpSdk\Response;

class Refund
{
    const RESULT_SUCCESS = "SUCCESS";
    const RESULT_FAILURE = "FAILURE";
    const RESULT_INCOMPLETE = "INCOMPLETE";

    /**
     * @var string|null
     */
    protected $result;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $merchantReference;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->result = $fields['result'] ?? null;
        $this->message = $fields['message'] ?? null;
        $this->orderId = $fields['orderId'] ?? null;
        $this->merchantReference = $fields['merchantReference'] ?? null;
        $this->amount = $fields['amount'] ?? null;
        $this->currency = $fields['currency'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Return a associated array respresentation of this object
     * @return array
     */
    public function toArray()
    {
        return [
            "Result"            =>$this->result, 
            "Message"           =>$this->message, 
            "OrderId"           =>$this->orderId, 
            "MerchantReference" =>$this->merchantReference, 
            "Amount"            =>$this->amount, 
            "Currency"          =>$this->currency
        ];
    }
}
