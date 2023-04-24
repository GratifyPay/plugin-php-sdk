<?php

namespace GratifyPay\PhpSdk;

use GratifyPay\PhpSdk\Request\InitOrder as OrderInitializeRequest;
use GratifyPay\PhpSdk\Request\InitManualOrder;
use GratifyPay\PhpSdk\Request\Refund as RefundRequest;
use GratifyPay\PhpSdk\Response\ConfirmOrder;
use GratifyPay\PhpSdk\Response\Refund as RefundResponse;
use GratifyPay\PhpSdk\Response\OrderInitialize as OrderInitializeResponse;
use GratifyPay\PhpSdk\Response\Merchant;
use GratifyPay\PhpSdk\Response\PaymentSchedule;

class Client extends Request
{
    // Production endpoints
    const API_ENDPOINT = 'https://api.gratifypay.com';
    const WEB_URL = 'https://app.gratifypay.com';

    // Sandbox endpoints
    const SANDBOX_API_ENDPOINT = 'https://api.gratifypay.com';
    const SANDBOX_WEB_URL = 'https://app.gratifypay.com';

    // Content type
    const TYPE_CONTENT = 'application/json';

    /**
     * @return string
     */
    public function getAPIEndpoint(): string {
        return $this->prod ? self::API_ENDPOINT : self::SANDBOX_API_ENDPOINT;
    }

    /**
     * @return string
     */
    public function getWebUrl(): string {
        return $this->prod ? self::WEB_URL : self::SANDBOX_WEB_URL;
    }

    /**
     * Check the connection
     * 
     * @return bool success connection or not
     */
    public function checkConnection(): bool {
        try {
            $result = $this->getMerchant();
        } 
        catch (\Exception $e) {
            return false;
        }

        if (!empty($result)) {
            return true;
        }

        return false;
    }

    /**
     * Check the API health page
     * 
     * @param bool $fast 
     * @param string $merchantId
     * @return int HTTP status of 200 OK or 500 SERVER ERROR
     */
    public function checkApiHealth(bool $fast = true, string $merchantId = null): int
    {
        $return = 200;
        try {
            if(empty($merchantId)) {
                $merchantId = $this->merchantPublicId;
            }
            $params = ['merchant_id' => $merchantId];
            $result = $this->request('GET', '/health' . $fast ? '/fast' : '' . $this->formatParams($params));
        } 
        catch (\Exception $e) {
            $return = 500;
        }

        if (empty($result)) {
            $return = 500;
        }

        return $return;
    }

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
     * @param bool $formatted
     * @return PaymentSchedule
     * @throws \Exception
     */
    public function getPaymentsSchedule(float $amount, bool $formatted = true): PaymentSchedule
    {
        $result = $this->request('GET', '/merchant/payment-schedule?amount=' . $amount . '&formatted=' . ($formatted ? 'true' : 'false'));

        $paymentSchedule = new PaymentSchedule($result);

        return $paymentSchedule;
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
     *
     * @param InitManualOrder $order
     * @return string
     * @throws \Exception
     */
    public function manualOrderInitialize(InitManualOrder $order): string
    {
        $result = $this->request(
            'POST', 
            '/merchant/ ' . $this->merchantPublicId . '/orderToken', $order
        );

        return $result['orderToken'];
    }

    /**
     * Request a Refund
     * 
     * @param string $merchantId
     * @param string orderId
     * @return RefundResponse
     * @throws \Exception
     */
    public function orderRefund(string $merchantId, string $orderId): RefundResponse
    {
        $result = $this->request('POST', "/merchant/{$merchantId}/order/{$orderId}/order-refund");

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

        $link = ($this->prod ? static::WEB_URL : static::SANDBOX_WEB_URL);

        return sprintf('%s/checkout?o=%s', $link, $orderMapId);
    }

    /**
     * Return $params as a Url formated parameter string
     * 
     * @param array $params
     * @return string
     */
    private function formatParams(array $params = []) 
    {
        return !empty($params) ? '?' . http_build_query($params) : '';
    }

}
