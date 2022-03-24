<?php

namespace GratifyPay\PhpSdk;

use GratifyPay\PhpSdk\Request\OrderInitialize as OrderInitializeRequest;
use GratifyPay\PhpSdk\Request\Refund as RefundRequest;
use GratifyPay\PhpSdk\Response\ConfirmOrder;
use GratifyPay\PhpSdk\Response\Refund as RefundResponse;
use GratifyPay\PhpSdk\Response\OrderInitialize as OrderInitializeResponse;
use GratifyPay\PhpSdk\Response\Merchant;
use GratifyPay\PhpSdk\Response\PaymentSchedules;

class Client extends Request
{
    //Production endpoints
    const API_ENDPOINT = 'https://api.gratifypay.com';

    const API_US_ENDPOINT = 'https://api.us.gratify.com';

    const WEB_URL = 'https://app.gratifypay.com';

    const US_WEB_URL = 'https://portal.gratify.com';

    //Sandbox endpoints
    //todo enable after production realise
    /*const SANDBOX_API_ENDPOINT = 'https://api.gratifypay.com';

    const SANDBOX_API_US_ENDPOINT = 'https://api.us-sandbox.gratify.com';

    const SANDBOX_WEB_URL = 'https://app.gratifypay.com';

    const SANDBOX_US_WEB_URL = 'https://portal.sandbox.gratify.com';*/

    //todo remove after production realise
    const SANDBOX_API_ENDPOINT = 'https://api.gratifypay.com';

    const SANDBOX_API_US_ENDPOINT = 'https://api.gratifypay.com';

    const SANDBOX_WEB_URL = 'https://app.gratifypay.com';

    const SANDBOX_US_WEB_URL = 'https://app.gratifypay.com';

    const TYPE_CONTENT = 'application/json';

    protected $privateApiKey = '';

    /**
     * @return Merchant
     * @throws \Exception
     */
    public function getMerchant(): Merchant
    {
        $result = $this->request('GET', '/merchant');

        return new Merchant($result);
    }

    /**
     * @param float $amount
     * @return PaymentSchedules
     * @throws \Exception
     */
    public function getPaymentsSchedule(float $amount, bool $formatted = true): PaymentSchedules
    {
        $result = $this->request('GET', '/merchant/payment-schedule?amount=' . $amount . '&formatted=' . ($formatted ? 'true' : 'false'));

        return new PaymentSchedules($result);
    }

    /**
     *
     * @param OrderInitializeRequest $order
     * @return Response\OrderInitialize
     * @throws \Exception
     */
    public function orderInitialize(OrderInitializeRequest $order): OrderInitializeResponse
    {
        $result = $this->request('POST', '/merchant/initialize-order', $order);

        return new OrderInitializeResponse($result);
    }

    /**
     * @param string $orderId
     * @param string $merchantReference
     * @param string $storePlatform
     * @return ConfirmOrder
     * @throws \Exception
     */
    public function confirmationOrder(string $orderId, string $merchantReference, string $storePlatform)
    {
        $result = $this->request(
            'GET',
            '/merchant/confirm-order?orderId=' . $orderId . '&merchantId=' . $this->merchantPublicId . '&merchantReference=' . $merchantReference . '&storePlatform=' . $storePlatform
        );

        return new ConfirmOrder($result);
    }

    /**
     * @param RefundRequest $refund
     * @return RefundResponse
     * @throws \Exception
     */
    public function orderRefund(RefundRequest $refund): RefundResponse
    {
        $result = $this->request('POST', '/merchant/order/order-refund', $refund);

        return new RefundResponse($result);
    }

    public function getReturnURL($orderMapId)
    {
        $result = $this->request('POST', '/returnURL?key=' . (string)$orderMapId);
    }

    /**
     * @param $orderMapId
     * @return string
     */
    public function getRedirectLink($orderMapId)
    {
        if (empty($orderMapId)) {
            return $orderMapId;
        }

        $link = $this->isUS
            ? ($this->isLive ? static::US_WEB_URL : static::SANDBOX_US_WEB_URL)
            : ($this->isLive ? static::WEB_URL : static::SANDBOX_WEB_URL);

        return sprintf('%s/checkout?o=%s', $link, $orderMapId);
    }
}
