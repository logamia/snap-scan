<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;

class PaymentsResponse extends BaseResponse
{

    /**
     * @var PaymentResponse[]
     */
    protected $payments;

    public function setData(array $data)
    {
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

        if(isset($this->payments[$paymentResponse->getId()])) {
            return;
        }
        $this->payments[$paymentResponse->getId()] = $paymentResponse;
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