<?php

namespace GratifyPay\PhpSdk\Response;

class Refund
{
    /**
     * @var string|null
     */
    protected $refundStatus;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @var bool
     */
    protected $success;

    public const REFUND_REFUNDED = 'REFUNDED';
    public const REFUND_DECLINED = 'DECLINED';
    public const REFUND_ERROR = 'ERROR';

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->refundStatus = $fields['refundStatus'] ?? null;
        $this->message = $fields['message'] ?? null;
        $this->success = $fields['success'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getRefundStatus()
    {
        return $this->refundStatus;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }
}
