<?php

namespace GratifyPay\PhpSdk\Response;

class Merchant
{
    /**
     * @var string|null
     */
    protected $id;
    /**
     * @var string|null
     */
    protected $sk;
    /**
     * @var string|null
     */
    protected $userId;
    /**
     * @var string|null
     */
    protected $merchantId;
    /**
     * @var string|null
     */
    protected $GS2PK;
    /**
     * @var string|null
     */
    protected $createdAt;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $email;
    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var int|null
     */
    protected $weekDelta;
    /**
     * @var int|null
     */
    protected $numPayments;
    /**
     * @var int|null
     */
    protected $minAmount;
    /**
     * @var int|null
     */
    protected $maxAmount;
    /**
     * @var string|null
     */
    protected $amId;
    /**
     * @var string|null
     */
    protected $created;
    /**
     * @var string|null
     */
    protected $updated;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->id = $fields['id'] ?? null;
        $this->sk = $fields['sk'] ?? null;
        $this->userId = $fields['userId'] ?? null;
        $this->merchantId = $fields['merchantId'] ?? null;
        $this->GS2PK = $fields['GS2PK'] ?? null;
        $this->createdAt = $fields['createdAt'] ?? null;
        $this->name = $fields['name'] ?? null;
        $this->email = $fields['email'] ?? null;
        $this->phone = $fields['phone'] ?? null;

        if (isset($fields['address'])) {
            $this->address = new Address($fields['address']);
        }

        $this->weekDelta = $fields['weekDelta'] ?? null;
        $this->numPayments = $fields['numPayments'] ?? null;
        $this->minAmount = $fields['minAmount'] ?? null;
        $this->maxAmount = $fields['maxAmount'] ?? null;
        $this->amId = $fields['amId'] ?? null;
        $this->created = $fields['created'] ?? null;
        $this->updated = $fields['updated'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSk()
    {
        return $this->sk;
    }

    /**
     * @return string|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string|null
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return string|null
     */
    public function getGS2PK()
    {
        return $this->GS2PK;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @return int|null
     */
    public function getWeekDelta()
    {
        return $this->weekDelta;
    }

    /**
     * @return int|null
     */
    public function getNumPayments()
    {
        return $this->numPayments;
    }

    /**
     * @return int|null
     */
    public function getMinAmount()
    {
        return $this->minAmount;
    }

    /**
     * @return int|null
     */
    public function getMaxAmount()
    {
        return $this->maxAmount;
    }

    /**
     * @return string|null
     */
    public function getAmId()
    {
        return $this->amId;
    }

    /**
     * @return string|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
