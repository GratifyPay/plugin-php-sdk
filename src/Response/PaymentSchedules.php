<?php

namespace GratifyPay\PhpSdk\Response;

class PaymentSchedules
{
    /**
     * @var PaymentSchedule[]|null
     */
    protected $schedules;

    /**
     * @var Meta|null
     */
    protected $meta;

    /**
     * @param array $schedules
     */
    public function __construct(array $schedules)
    {
        foreach ($schedules['schedule'] as $schedule) {
            $this->schedules[] = new PaymentSchedule($schedule);
        }

        if (isset($schedules['meta'])) {
            $this->meta = new Meta($schedules['meta']);
        }
    }

    /**
     * @return PaymentSchedule[]|null
     */
    public function getSchedules(): ?array
    {
        return $this->schedules;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
