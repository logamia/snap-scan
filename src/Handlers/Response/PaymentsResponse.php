<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;

use GuzzleHttp\Message\Response;

class PaymentsResponse extends BaseResponse
{

    /**
     * @var PaymentResponse[]
     */
    protected $payments;

    public function __construct(Response $response)
    {
        parent::__construct($response);

        $data = $this->getResponseBody();
        if(!is_array($data)) {
            $data = json_decode($data, true);
        }


        foreach ($data as $payment) {
            $this->addPayment($payment);
        }

    }

    /**
     * @return PaymentResponse[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param PaymentResponse[] $payments
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
    }

    public function addPayment($payment)
    {
        $paymentResponse = new PaymentResponse($this->getResponse(), false);
        $paymentResponse->setData($payment);

        $this->payments[$paymentResponse->getId()] = $paymentResponse;
        $this->payments = array_unique($this->payments);
    }

    public function toArray()
    {
        $payments = [];
        /** @var PaymentResponse $payment */
        foreach ($this->getPayments() as $payment)
        {
            $payments[$payment->getId()] = $payment->toArray();
        }

        return $payments;

    }

}