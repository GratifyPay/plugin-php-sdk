<?php

namespace Gratify\PhpSdk\Response;

/**
 *
 */
class Meta
{
    /**
     * @var string
     */
    protected $totalAmount;

    /**
     * @var int
     */
    protected $numPayments;

    /**
     * @param array $meta
     */
    public function __construct(array $meta)
    {
        $this->numPayments = $meta['numPayments'] ?? null;
        $this->totalAmount = $meta['totalAmount'] ?? null;
    }

    /**
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @return int
     */
    public function getNumPayments()
    {
        return $this->numPayments;
    }
}
