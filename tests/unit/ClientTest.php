<?php
use PHPUnit\Framework\TestCase;
use GratifyPay\PhpSdk\Client;


class ClientTest extends TestCase
{
    protected static $client;

    public static function setUpBeforeClass(): void
    {
        self::$client = new Client('123','456', false);
    }

    public function testIsProdGetter(): void
    {
        $this->assertFalse(self::$client->isProd(), "Is production should be set to false.");
    }

    public function testUseragentGetterSetter(): void
    {
        $useragent = "TEST USER AGENT";
        self::$client->setUseragent($useragent);
        $this->assertEquals(self::$client->getUseragent(), $useragent);
    }
}