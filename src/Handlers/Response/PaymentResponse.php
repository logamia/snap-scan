<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;

use GuzzleHttp\Message\Response;

class PaymentResponse extends BaseResponse
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var int
     */
    protected $totalAmount;

    /**
     * @var int
     */
    protected $tipAmount;

    /**
     * @var int
     */
    protected $requiredAmount;

    /**
     * @var string
     */
    protected $snapCode;

    /**
     * @var string
     */
    protected $snapCodeReference;

    /**
     * @var string
     */
    protected $userReference;

    /**
     * @var string
     */
    protected $merchantReference;

    /**
     * @var string
     */
    protected $statementReference;

    /**
     * @var int
     */
    protected $authCode;

    /**
     * @var string
     */
    protected $extra;

    /**
     * @var string
     */
    protected $deliveryAddress;

    public function __construct(Response $response, $setData = true)
    {
        parent::__construct($response);
        $data = $this->getResponseBody();

        if(!$setData) {
            return true;
        }

        if(!is_array($data)) {
            $data = json_decode($data, true);
        }

        $this->setData($data);
    }

    public function setData(array $data)
    {
        foreach ($data as $property => $value) {
            if(!property_exists($this, $property)) {
                continue;
            }
            $this->$property = $value;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return int
     */
    public function getTipAmount()
    {
        return $this->tipAmount;
    }

    /**
     * @param int $tipAmount
     */
    public function setTipAmount($tipAmount)
    {
        $this->tipAmount = $tipAmount;
    }

    /**
     * @return int
     */
    public function getRequiredAmount()
    {
        return $this->requiredAmount;
    }

    /**
     * @param int $requiredAmount
     */
    public function setRequiredAmount($requiredAmount)
    {
        $this->requiredAmount = $requiredAmount;
    }

    /**
     * @return string
     */
    public function getSnapCode()
    {
        return $this->snapCode;
    }

    /**
     * @param string $snapCode
     */
    public function setSnapCode($snapCode)
    {
        $this->snapCode = $snapCode;
    }

    /**
     * @return string
     */
    public function getSnapCodeReference()
    {
        return $this->snapCodeReference;
    }

    /**
     * @param string $snapCodeReference
     */
    public function setSnapCodeReference($snapCodeReference)
    {
        $this->snapCodeReference = $snapCodeReference;
    }

    /**
     * @return string
     */
    public function getUserReference()
    {
        return $this->userReference;
    }

    /**
     * @param string $userReference
     */
    public function setUserReference($userReference)
    {
        $this->userReference = $userReference;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @param string $merchantReference
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;
    }

    /**
     * @return string
     */
    public function getStatementReference()
    {
        return $this->statementReference;
    }

    /**
     * @param string $statementReference
     */
    public function setStatementReference($statementReference)
    {
        $this->statementReference = $statementReference;
    }

    /**
     * @return int
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @param int $authCode
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
    }

    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param string $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }


    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'date' => $this->getDate(),
            'totalAmount' => $this->getTotalAmount(),
            'idtipAmount' => $this->getTipAmount()
        ];
    }

}