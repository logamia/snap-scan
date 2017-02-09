<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


class CashupResponse extends BaseResponse
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->getFormattedDate($this->date);
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function toArray()
    {
        return [
            'date' => $this->getDate(),
            'reference' => $this->getReference()
        ];
    }
}