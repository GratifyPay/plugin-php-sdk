<?php

namespace GratifyPay\PhpSdk\Request;

class Item
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $description;
    /**
     * @var int
     */
    public $quantity;
    /**
     * @var float
     */
    public $price;
    /**
     * @var float
     */
    public $totalPrice;
    /**
     * @var string
     */
    public $imageURL;

    /**
     * @param mixed $id
     */
    public function setId($id): Item
    {
        // enforce shoppingitem_ prefix
        $prefix = 'shoppingitem_';
        if(substr((string)$id, 0, strlen($prefix)) !== $prefix)
        {
            $id = 'shoppingitem_' . $id;    
        }
        $this->id = $id;

        return $this;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): Item
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): Item
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): Item
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): Item
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice): Item
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @param mixed $imageURL
     */
    public function setImageURL($imageURL): Item
    {
        $this->imageURL = $imageURL;

        return $this;
    }
}
