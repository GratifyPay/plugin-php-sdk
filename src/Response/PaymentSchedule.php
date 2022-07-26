<?php

namespace GratifyPay\PhpSdk\Response;

use GratifyPay\PhpSdk\Response\Schedule;
use GratifyPay\PhpSdk\Response\Meta;

class PaymentSchedule
{
    /**
     * @var Schedule[]
     */
    protected array $schedule;

    /**
     * @var Meta
     */
    protected Meta $meta;

    /**
     * @return Schedule[]
     */
    public function getSchedule() : array
    {
        return $this->schedule;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }

    /**
     * @param array $schedule
     */
    public function __construct(array $paymentSchedule)
    {
        foreach ($paymentSchedule['schedule'] as $schedule) {
            $this->schedule[] = new Schedule($schedule);
        }

        if (isset($paymentSchedule['meta'])) {
            $this->meta = new Meta($paymentSchedule['meta']);
        }
    }


    /**
     * To associated array
     * 
     * @return array
     */
    public function toArray(): array {
        $array = [
            "schedule" => [],
            "meta" => []
        ];
        foreach($this->schedule as $s){
            $array["schedule"][] = $s->toArray();
        }
        if(!empty($this->meta))
        {
            $array["meta"] = $this->meta->toArray();
        }
        return $array;
    }

    /**
     * to JSON
     * 
     * @return string
     */
    public function toJSON(): string {
        return json_encode($this->toArray());
    }

    /**
     * Static to JSON
     * 
     * @param PaymentSchedule $paymentSchedule
     * @return string
     */
    public static function paymentScheduleToJSON(PaymentSchedule $paymentSchedule): string {
        return $paymentSchedule->toJSON();
    }
}
