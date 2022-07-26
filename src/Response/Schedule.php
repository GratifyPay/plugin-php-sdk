<?php

namespace GratifyPay\PhpSdk\Response;

/**
 *
 */
class Schedule
{
    /**
     * @var mixed array of date components or a string date
     */
    protected $date;

    /**
     * @var float the instalment amount
     */
    protected float $amount;

    /**
     * @var string the description of the payment numbner
     */
    protected string $paymentNumber;

    /**
     * @var string the description of when the amount is due
     */
    protected $dueFromNow;

    /**
     * @var string the total amount due, with formatting
     */
    protected $totalAmount;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getPaymentNumber(): string
    {
        return $this->paymentNumber;
    }

    /**
     * @return string
     */
    public function getDueFromNow(): string
    {
        return $this->dueFromNow;
    }

    /**
     * @return string
     */
    public function getTotalAmount(): string
    {
        return $this->totalAmount;
    }

    /**
     * @param array $schedule
     */
    public function __construct(array $schedule)
    {
        $this->date = $schedule['date'] ?? null;
        $this->amount = $schedule['amount'] ?? null;
        $this->paymentNumber = $schedule['paymentNumber'] ?? null;
        $this->dueFromNow = $schedule['dueFromNow'] ?? null;
        $this->totalAmount = $schedule['totalAmount'] ?? null;
    }

    /**
     * To associated array
     * 
     * @return array
     */
    public function toArray(): array {
        if(is_array($this->getDate())) {
            return [
                "date"   => $this->getDate(),
                "amount" => $this->getAmount(),
                "paymentNumber" => $this->getPaymentNumber(),
                "dueFromNow" => $this->getDueFromNow(),
                "totalAmount" => $this->getTotalAmount(),
            ];
        } else {
            return [
                "date"   => $this->getDate(),
                "amount" => $this->getAmount(),
            ];
        }
    }
}
