<?php

namespace Gratify\PhpSdk\Request;

class RefundItem
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $sku;

    /**
     * @var float
     */
    public $price;

    /**
     * @var float
     */
    public $qty;
    /**
     * @var float
     */
    public $totalPrice;

    /**
     * @param string $id
     * @return RefundItem
     */
    public function setId(string $id): RefundItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $sku
     * @return RefundItem
     */
    public function setSku(string $sku): RefundItem
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @param float $price
     * @return RefundItem
     */
    public function setPrice(float $price): RefundItem
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param float $qty
     * @return RefundItem
     */
    public function setQty(float $qty): RefundItem
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * @param float $totalPrice
     * @return RefundItem
     */
    public function setTotalPrice(float $totalPrice): RefundItem
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
