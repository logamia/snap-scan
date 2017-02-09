<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


class ErrorResponse extends BaseResponse
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $reasonPhrase;

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }

    /**
     * @param string $reasonPhrase
     */
    public function setReasonPhrase($reasonPhrase)
    {
        $this->reasonPhrase = $reasonPhrase;
    }

    public function toArray()
    {
        return [
            'message'      => $this->getMessage(),
            'reasonPhrase' => $this->getReasonPhrase(),
        ];
    }


}