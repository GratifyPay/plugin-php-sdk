<?php

namespace Gratify\PhpSdk\Request;

class Refund
{
    /**
     * @var string
     */
    public $orderId;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var string
     */
    public $merchantRefundId;
    /**
     * @var string
     */
    public $storePlatform;

    /**
     * Currency ISO code
     *
     * @var string
     */
    public $currency;

    /**
     * @param $orderId
     * @return $this
     */
    public function setOrderId($orderId): Refund
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount): Refund
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param RefundItem $refundItems
     * @return Refund
     */
    public function setRefundItems(RefundItem $refundItems): Refund
    {
        $this->refundItems[] = $refundItems;

        return $this;
    }

    /**
     * @param $merchantRefundId
     * @return $this
     */
    public function setMerchantRefundId($merchantRefundId): Refund
    {
        $this->merchantRefundId = $merchantRefundId;

        return $this;
    }

    /**
     * @param string $storePlatform
     * @return Refund
     */
    public function setStorePlatform(string $storePlatform)
    {
        $this->storePlatform = $storePlatform;

        return $this;
    }

    /**
     * @param string $currency
     * @return Refund
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }
}
