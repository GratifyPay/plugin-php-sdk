<?php
use PHPUnit\Framework\TestCase;
use GratifyPay\PhpSdk\Client;
use GratifyPay\PhpSdk\Response\Merchant;
use GratifyPay\PhpSdk\Response\PaymentSchedule;
use GratifyPay\PhpSdk\Response\Schedule;
use GratifyPay\PhpSdk\Response\Meta;



class ClientAPITest extends TestCase
{   
    private static $merchantId;
    private static $secretKey;
    protected static $client;

    //"merchant_20tDfdLtIeHux3kEO4Fumz";
    //"gpKey_75BRrcncNUAhnNu2ZxrOhQ";

    public static function setUpBeforeClass(): void
    {
        self::$merchantId = getenv('MERCHANT_ID');
        self::$secretKey = getenv('SECRET_KEY');

        if(empty(self::$merchantId) || empty(self::$secretKey)) {
            error_log("Please export both MERCHANT_ID and SECRET_KEY environment varables before running tests!");
        } else {
            self::$client = new Client(self::$merchantId, self::$secretKey, false);
        }
    }

    protected function setUp(): void
    {
        if(empty(self::$client)) {
            self::markTestSkipped("No client connection!");
        }

    }

    public static function tearDownAfterClass(): void
    {
        self::$client = null;
    }

    public function testGetMerchant(): void
    {
        $merchant = self::$client->getMerchant();

        $this->assertInstanceOf(
            Merchant::class,
            $merchant
        );

        $this->assertNotEmpty($merchant->getId());
        $this->assertNotEmpty($merchant->getName());
        $this->assertNotEmpty($merchant->getEmail());
        $this->assertNotEmpty($merchant->getPhone());
        $this->assertNotEmpty($merchant->getNumPayments());
        $this->assertGreaterThanOrEqual($merchant->getMinAmount(), 0);
        $this->assertNotEmpty($merchant->getMaxAmount());
        $this->assertNotEmpty($merchant->getMerchantState());
        $this->assertNotEmpty($merchant->getCurrency());
    }

    public function testGetPaymentSchedule(): void
    {
        $paySchedule = self::$client->getPaymentsSchedule(500, true);

        $this->assertNotEmpty($paySchedule);

        $this->assertInstanceOf(
            PaymentSchedule::class,
            $paySchedule
        );


        foreach($paySchedule->getSchedule() as $s) {
            $this->assertInstanceOf(
                Schedule::class,
                $s
            );

            $this->assertIsNumeric($s->getAmount());
            $this->assertIsArray($s->getDate());
            $this->assertIsString($s->getPaymentNumber());
            $this->assertIsString($s->getDueFromNow());
            $this->assertIsString($s->getTotalAmount());

            $a = $s->toArray();

            $this->assertEquals($a['amount'], $s->getAmount());
            $this->assertEquals($a['date'], $s->getDate());
            $this->assertEquals($a['paymentNumber'], $s->getPaymentNumber());
            $this->assertEquals($a['dueFromNow'], $s->getDueFromNow());
            $this->assertEquals($a['totalAmount'], $s->getTotalAmount());
        }

        foreach($paySchedule->getMeta() as $m) {
            $this->assertInstanceOf(
                Meta::class,
                $m
            );

            $this->assertIsString($m->getTotalAmount());
            $this->assertIsNumeric($m->getNumPayments());
        }

        $this->assertIsString($paySchedule->toJSON());
    }
}
