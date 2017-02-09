<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


use GuzzleHttp\Message\Response;

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

    public function __construct(Response $response)
    {
        parent::__construct($response);
        $this->setReasonPhrase($response->getReasonPhrase());
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if(!empty($this->getResponseBody()['message'])) {
            return $this->message;
        }
        return null;
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

}