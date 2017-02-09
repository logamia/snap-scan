<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


use GuzzleHttp\Message\Response;

abstract class BaseResponse
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $responseBody;

    /**
     * @var mixed
     */
    protected $response;


    public function __construct(Response $response)
    {
        $this->setResponse($response);
        $this->setStatusCode($response->getStatusCode());
        $this->setResponseBody($response->json());
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param array $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    abstract public function toArray();
}