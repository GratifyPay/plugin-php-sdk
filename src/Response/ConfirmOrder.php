<?php

namespace GratifyPay\PhpSdk\Response;

class ConfirmOrder
{
    /**
     * @var mixed|null
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $merchantReference;

    /**
     * CREATED
     *
     * @var string
     */
    protected $orderStatus;

    /**
     * @var string
     */
    protected $storePlatform;

    const ORDER_STATUS_CREATED = 'CREATED';

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->orderId =            $fields['orderId'] ?? null;
        $this->merchantReference =  $fields['merchantReference'] ?? null;
        $this->orderStatus =        $fields['orderStatus'] ?? null;
        $this->storePlatform =      $fields['storePlatform'] ?? null;
    }

    /**
     * @return mixed|null
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
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @return string
     */
    public function getStorePlatform()
    {
        return $this->storePlatform;
    }
}
