<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan;


use SnapScan\Utils\Constants;

class Config
{
    /**
     * @var $merchantId
     */
    protected $merchantId;
    protected $apiToken;
    protected $apiEndpoint;
    protected $merchantEndpoint;
    protected $qrCodeExtension;

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        if(empty($this->apiEndpoint)) {
            $this->setApiEndpoint(Constants::SNAPSCAN_API_ENDPOINT);
        }
        return $this->apiEndpoint;
    }

    /**
     * @param string $apiEndpoint
     */
    public function setApiEndpoint($apiEndpoint)
    {
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * @return string
     */
    protected function getMerchantEndpoint()
    {
        return "{$this->getApiEndpoint()}/merchant/api/v1";
    }

    /**
     * @return mixed
     */
    public function getQrCodeExtension()
    {
        if(empty($this->qrCodeExtension)) {
            $this->setQrCodeExtension('png');
        }
        return $this->qrCodeExtension;
    }

    /**
     * @param mixed $qrCodeExtension
     */
    public function setQrCodeExtension($qrCodeExtension)
    {
        $this->qrCodeExtension = $qrCodeExtension;
    }


    /**
     * @param $merchantCode
     *
     * @return string
     */
    public function getQREndPoint($merchantCode)
    {
        return sprintf("{$this->getApiEndpoint()}/qr/%s.{$this->getQrCodeExtension()}",$merchantCode);
    }

    /**
     * @return string
     */
    public function getPaymentsEndpoint()
    {
        return "{$this->getMerchantEndpoint()}/payments";
    }

    /**
     * @param $paymentId
     *
     * @return string
     */
    public function getSinglePaymentEndpoint($paymentId)
    {
        return sprintf("{$this->getPaymentsEndpoint()}/%s", $paymentId);
    }


    public function getCashupsEndpoint()
    {
        return "{$this->getMerchantEndpoint()}/cash_ups";
    }

    /**
     * @param $reference
     *
     * @return string
     */
    public function getPaymentsCashupEndpoint($reference)
    {
        return sprintf("{$this->getPaymentsEndpoint()}/cash_ups/%s",$reference);
    }


}