<?php

namespace Gratify\PhpSdk\Response;

class OrderInitialize
{
    protected $orderMapId;

    protected $orderId;

    public function __construct(array $fields)
    {
        $this->orderMapId = $fields['orderMapId'] ?? null;
        $this->orderId = $fields['orderId'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getOrderMapId()
    {
        return $this->orderMapId;
    }

    /**
     * @return mixed|null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
