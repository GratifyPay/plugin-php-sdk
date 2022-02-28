<?php

namespace Gratify\PhpSdk\Response;

class PaymentSchedule
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var double
     */
    protected $amount;

    protected $paymentNumber;

    protected $dueFromNow;

    protected $totalAmount;

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
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed|null
     */
    public function getPaymentNumber()
    {
        return $this->paymentNumber;
    }

    /**
     * @return mixed|null
     */
    public function getDueFromNow()
    {
        return $this->dueFromNow;
    }

    /**
     * @return mixed|null
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
}
