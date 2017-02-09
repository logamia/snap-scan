<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


class CashupsResponse extends BaseResponse
{
    /**
     * @var CashupResponse[]
     */
    protected $cashups;

    public function setData(array $data)
    {
        foreach ($data as $cashup) {
            $this->addCashup($cashup);
        }
    }

    /**
     * @return CashupResponse[]
     */
    public function getCashups()
    {
        return $this->cashups;
    }

    public function addCashup($cashup)
    {
        $cashupResponse = new CashupResponse($this->getResponse(), false);
        $cashupResponse->setData($cashup);

        if(isset($this->cashups[$cashupResponse->getReference()])) {
            return;
        }

        $this->cashups[$cashupResponse->getReference()] = $cashupResponse;
    }

    public function getCashupByReference($reference)
    {
        return !empty($this->getCashups()[$reference])? $this->getCashups()[$reference] : null;
    }

    public function toArray()
    {
        $cashups = [];
        /** @var CashupResponse $cashup */
        foreach ($this->getCashups() as $cashup)
        {
            $cashups[$cashup->getReference()] = $cashup->toArray();
        }

        return $cashups;
    }


}