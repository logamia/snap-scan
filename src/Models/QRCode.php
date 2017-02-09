<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Models;

class QRCode
{
    /**
     * @var string
     */
    protected $snapCode;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var bool
     */
    protected $strict = true;

    /**
     * @var int
     */
    protected $snapCodeSize;

    /**
     * @var bool
     */
    protected $returnImageUriOnly = false;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return boolean
     */
    public function isStrict()
    {
        return $this->strict;
    }

    /**
     * @param boolean $strict
     */
    public function setStrict($strict)
    {
        $this->strict = $strict;
    }

    /**
     * @return int
     */
    public function getSnapCodeSize()
    {
        return $this->snapCodeSize;
    }

    /**
     * @param int $snapCodeSize
     */
    public function setSnapCodeSize($snapCodeSize)
    {
        $this->snapCodeSize = $snapCodeSize;
    }

    /**
     * @return boolean
     */
    public function isReturnImageUriOnly()
    {
        return $this->returnImageUriOnly;
    }

    /**
     * @param boolean $returnImageUriOnly
     */
    public function setReturnImageUriOnly($returnImageUriOnly)
    {
        $this->returnImageUriOnly = $returnImageUriOnly;
    }



    public function exportToArray()
    {
        return [
            'snapCode'       => $this->getSnapCode(),
            'id'             => $this->getId(),
            'amount'         => $this->getAmount(),
            'strict'         => $this->isStrict(),
            'snap_code_size' => $this->getSnapCodeSize(),
        ];
    }
}