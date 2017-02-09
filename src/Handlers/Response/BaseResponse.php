<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers\Response;


use Carbon\Carbon;
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


    public function __construct(Response $response, $setData = true)
    {
        $this->setResponse($response);
        $this->setStatusCode($response->getStatusCode());
        $this->setResponseBody($response->json());

        $data = $this->getResponseBody();

        if(!$setData) {
            return true;
        }

        if(!is_array($data)) {
            $data = json_decode($data, true);
        }

        $this->setData($data);
    }

    public function setData(array $data)
    {
        foreach ($data as $property => $value) {
            if(!property_exists($this, $property)) {
                continue;
            }
            $this->$property = $value;
        }
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

    public function getFormattedDate($date, $format = 'Y-m-d H:i:s')
    {
        $date = Carbon::parse($date);
        return $date->format($format);
    }

    abstract public function toArray();
}