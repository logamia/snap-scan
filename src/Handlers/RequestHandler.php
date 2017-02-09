<?php
/**
 * @author: Gavin Schreiber gavin@zando.co.za
 */

namespace SnapScan\Handlers;

use GuzzleHttp\Client;
use SnapScan\Config;
use \Exception;
use GuzzleHttp\Exception\RequestException;
use SnapScan\Exceptions\MethodNotAllowedException;
use SnapScan\Handlers\Request\BaseRequest;
use SnapScan\Handlers\Response\ErrorResponse;
use SnapScan\Utils\Constants;

class RequestHandler
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Config;
     */
    protected $config;

    protected $allowedHttpMethods = [
        'GET',
        'POST'
    ];

    protected $allowedApiMethods = [
        'payments',
        'cash_ups'
    ];


    public function __construct(Config $config)
    {
        $this->setClient(new Client());
        $this->setConfig($config);
    }

    public function doRequest($method, $endpoint, BaseRequest $data = null, $responseClassMapping = null)
    {
        try {
            $this->validateHttpMethod($method);

            $options = [
                'auth' => [
                    $this->getConfig()->getApiToken(),
                    ''
                ],
                'query' => ($data instanceof BaseRequest)? $data->exportToArray() : [],
                'proxy'     => '127.0.0.1:8888',
                'verify'       => false
            ];

            switch ($method) {
                case Constants::HTTP_METHOD_POST:
                    $response = $this->getClient()->post($endpoint, $options);
                    break;
                case Constants::HTTP_METHOD_GET:
                default:
                    $response = $this->getClient()->get($endpoint, $options);
                    break;
            }

            $responseContent = $response->json();
            if(empty($responseClassMapping)) {
                return $responseContent;
            }

            return new $responseClassMapping($response);
        } catch (RequestException $e) {
            $result = new ErrorResponse($e->getResponse());
            return $result;
        } catch (MethodNotAllowedException $e) {

        } catch (Exception $e) {

        }
    }


    private function request($method = "GET", $action = "payments", $params=[])
    {
        $method = strtolower($method);
        $action = strtolower($action);

        if (empty($method) || !in_array($method, $this->allowedHttpMethods)) {
            throw new Exception("class.SnapScan.php |
                request($method) Requires a valid request method.
                Options(".implode(' ,', $this->allowedHttpMethods).")", 1
            );
        }

        // Ensure we have an API Token
        if (empty($this->apiToken)) {
            throw new Exception("class.SnapScan.php |
                request($method) requires that you had used setApiToken($token) to set your API token", 1
            );
        }

        // Ensure we have an API End Point
        if (empty($this->apiEndPoint) || filter_var($this->apiEndPoint, FILTER_VALIDATE_URL) === false) {
            throw new Exception("class.SnapScan.php |
                request($method) Failed to get the API EndPoint. This should be the same all the time really", 1
            );
        }

        // Ensure that the action is set
        if (empty($action) || !in_array($action, $this->allowedApiMethods)) {
            throw new Exception("class.SnapScan.php |
                request($method) Which action do you need to perform?
                Options (".implode(' ,', $this->allowedApiMethods).")", 1
            );
        }

        // Additional parameters
        $queryString = "";
        if ($method === 'get' && !empty($params)) {
            $queryString = "?".http_build_query($params);
        }

        // Assemble the final URL
        $finalUrl = $this->apiEndPoint."/".$action.$queryString;

        // Actually do the query
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $finalUrl,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->apiToken . ":",
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT, 10
        ));
        $result = curl_exec($curl);
        $error = curl_error($curl);
        $curlInfo = curl_getinfo($curl);
        curl_close($curl);

        // Auth Issues
        if (!empty($curlInfo['http_code']) && $curlInfo['http_code'] == 401) {
            throw new Exception("class.SnapScan.php |
                Authorization Failed, Your API Token is most likely invalid", 1
            );
        }

        // Non-Success Response
        if (!empty($curlInfo['http_code']) && $curlInfo['http_code'] !== 200) {
            throw new Exception("class.SnapScan.php |
                Something went wrong with your request.
                Response Code {$curlInfo['http_code']}
                Response Text {$result}", 1
            );
        }

        // Other Curl issues
        if (!empty($error)) {
            throw new Exception("class.SnapScan.php |
                Call to SnapScan failed: error {$error}", 1
            );
        }

        if ($result) {
            $decode = json_decode($result, true);
            if (!empty($decode)) {
                return $decode;
            }
        }
        return false;
    }

    private function validateHttpMethod($method)
    {
        if(!in_array($method, $this->allowedHttpMethods)) {
            throw new MethodNotAllowedException("$method, is an invalid HTTP method.");
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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



}