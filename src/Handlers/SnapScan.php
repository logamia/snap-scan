<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers;

use SnapScan\Config;
use SnapScan\Handlers\Response\PaymentsResponse;
use SnapScan\Models\QRCode;
use SnapScan\Utils\Constants;
use \Exception;

class SnapScan
{

    /**
     * @var Config;
     */
    protected $config;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $size;


    public $allowedFields = [
        Constants::QUERY_FIELD_MERCHANT_REFERENCE,
        Constants::QUERY_FIELD_START_DATE,
        Constants::QUERY_FIELD_END_DATE,
        Constants::QUERY_FIELD_STATUS,
        Constants::QUERY_FIELD_SNAP_CODE,
        Constants::QUERY_FIELD_AUTH_CODE,
        Constants::QUERY_FIELD_SNAP_CODE_REFERENCE,
        Constants::QUERY_FIELD_USER_REFERENCE,
        Constants::QUERY_FIELD_STATEMENT_REFERENCE,
    ];

    /**
     * SnapScan constructor.
     *
     * @param Config $config
     *
     * @throws Exception
     */
    public function __construct(Config $config)
    {
        if(empty($config->getMerchantId())) {
            throw new Exception("Merchant ID must be set.", 1);
        }

        $this->setConfig($config);

    }

    protected function getRequestHandler()
    {
        return new RequestHandler($this->getConfig());
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        if(empty($this->size)) {
            $this->setSize(Constants::QRCODE_DEFAULT_SIZE);
        }

        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function generateQRCodeImage(QRCode $data)
    {
        $query = http_build_query($data->exportToArray());
        $url = "{$this->getConfig()->getQREndPoint($this->getConfig()->getMerchantId())}?$query";
        if($data->isReturnImageUriOnly()) {
            return $url;
        }

        return "<img src='$url'/>";
    }


    public function getAllPayments()
    {
        return $this->getRequestHandler()->doRequest(
            Constants::HTTP_METHOD_GET,
            $this->getConfig()->getPaymentsEndpoint(),
            null,
            PaymentsResponse::class
        );
    }

    public function getPayment($paymentId)
    {
        return $this->getRequestHandler()->doRequest(
            Constants::HTTP_METHOD_GET,
            $this->getConfig()->getSinglePaymentEndpoint($paymentId),
            null,
            PaymentsResponse::class
        );
    }

}