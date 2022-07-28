<?php

namespace GratifyPay\PhpSdk\Response;

/**
 *
 */
class Meta
{
    /**
     * @var string
     */
    protected string $totalAmount;

    /**
     * @var int
     */
    protected int $numPayments;

    /**
     * @return string
     */
    public function getTotalAmount(): string
    {
        return $this->totalAmount;
    }

    /**
     * @return int
     */
    public function getNumPayments(): int
    {
        return $this->numPayments;
    }

    /**
     * @param array $meta
     */
    public function __construct(array $meta)
    {
        $this->numPayments = $meta['numPayments'] ?? null;
        $this->totalAmount = $meta['totalAmount'] ?? null;
    }

    /**
     * To associated array
     * 
     * @return array
     */
    public function toArray(): array {
        return [
            "numPayments"   => $this->getNumPayments(),
            "totalAmount" => $this->getTotalAmount(),
        ];
    }
}
