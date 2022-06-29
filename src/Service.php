<?php

namespace GratifyPay\PhpSdk;

use Exception;

class Service
{
    /**
     * @var Client
     */
    protected $gratifyClient;

    /**
     * @param $merchantId
     * @param $secretKey
     * @param bool $live
     * @throws Exception
     */
    public function __construct($merchantId, $secretKey, bool $live = true)
    {
        $this->gratifyClient = new Client(
            $merchantId,
            $secretKey,
            $live
        );
    }

    /**
     * @param $price
     * @return bool
     * @throws Exception
     */
    public function isAvailable($price): bool
    {
        if ($price) {
            static $merchant;
            try {
                if (empty($merchant)) {
                    $merchant = $this->gratifyClient->getMerchant();
                }
            } catch (Exception $e) {
                return false;
            }
            if ($price >= $merchant->getMinAmount() && $price <= $merchant->getMaxAmount()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $price
     * @return array
     * @throws Exception
     */
    public function getFirstPaymentByPrice($price): array
    {
        $paymentSchedule = $this->gratifyClient->getPaymentsSchedule($price);
        $numPayments = count($paymentSchedule->getSchedules());
        $firstPayment = isset($paymentSchedule->getSchedules()[0]) ? $paymentSchedule->getSchedules()[0]->getAmount() : null;

        return [$numPayments, $firstPayment];
    }

    /**
     * @param $price
     * @return array|null
     * @throws Exception
     */
    public function getPaymentShedule($price): ?array
    {
        if (!$this->isAvailable($price)) {
            return null;
        }

        $schedules = [
            'schedules' => [],
            'meta' => [
                'numPayments' => 0,
                'totalAmount' => 0,
            ],
        ];
        if ($price) {
            $paymentSchedule = $this->gratifyClient->getPaymentsSchedule($price, true);

            foreach ($paymentSchedule->getSchedules() as $schedule) {
                $schedules['schedules'][] = [
                    'date' => $schedule->getDate(),
                    'amount' => $schedule->getAmount(),
                    'dueFromNow' => $schedule->getDueFromNow(),
                    'paymentNumber' => $schedule->getPaymentNumber(),
                    'totalAmount' => $schedule->getTotalAmount(),
                ];
            }

            $schedules['meta'] = [
                'numPayments' => $paymentSchedule->getMeta()->getNumPayments(),
                'totalAmount' => $paymentSchedule->getMeta()->getTotalAmount(),
            ];
        }

        return $schedules;
    }

    /**
     * @param $price
     * @param $page
     * @param bool $category
     * @param bool $product
     * @param bool $cart
     * @param $categoryPhrase
     * @param $productPhrase
     * @param $cartPhrase
     * @return array|mixed|string|string[]|void
     * @throws Exception
     */
    public function getPaymentPeriod(
        $price,
        $page,
        bool $category,
        bool $product,
        bool $cart,
        $categoryPhrase,
        $productPhrase,
        $cartPhrase
    ){
        switch ($page) {
            case 'category':
                if (!$category) {
                    return;
                }
                break;
            case 'product':
                if (!$product) {
                    return;
                }
                break;
            case 'cart':
                if (!$cart) {
                    return;
                }
                break;
        }

        if ($this->isAvailable($price)) {

            list($numPayments, $firstPayment) = $this->getFirstPaymentByPrice($price);

            $search = ['{NUM_PAYMENTS}', '{AMOUNT}', '{GRATIFY_LOGO}'];
            $replace = [
                $numPayments,
                $firstPayment,
                '<img style="margin-top:-3px;vertical-align:middle;display:inline-block;border:none;" src="https://assets.dev.gratifypay.com/img/gratify-badge-blue.svg" width="80" height="30" alt="Gratify Pay" />'
            ];
            $phrase = '';
            switch ($page) {
                case 'category':
                    $phrase = $categoryPhrase;
                    break;
                case 'product':
                    $phrase = $productPhrase;
                    break;
                case 'cart':
                    $phrase = $cartPhrase;
                    break;
            }

            return str_replace($search, $replace, $phrase);
        }
    }
}