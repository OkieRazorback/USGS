<?php


namespace USGS;

use GuzzleHttp;

/**
 * Class Client
 * @package USGS
 */
class Client
{
    /**
     * @var string
     */
    protected $baseURI = 'http://earthquake.usgs.gov';

    /**
     * @var string
     */
    protected $fdsnWebServiceURI = '/fdsnws/event/1/';

    /**
     * @var GuzzleHttp\Client|null
     */
    protected $client = null;

    /**
     * @var null
     */
    protected $action = null;

    /**
     * @var null
     */
    protected $request = null;

    /**
     * @var null
     */
    public $response = null;

    /**
     * @var null
     */
    public $statusCode = null;

    /**
     * @var null
     */
    public $detail = null;

    /**
     * @param null $httpClient
     */
    public function __construct($httpClient = null)
    {
        $this->client = (is_null($httpClient)) ? new GuzzleHttp\Client() : $httpClient;
    }

    /**
     * @param $uri
     * @param array $params
     * @return mixed
     */
    public function get($uri, $params = array())
    {
        $request = $this->client->createRequest('GET', $uri);

        foreach ($params as $key => $value) {
            $request->getQuery()->set($key, $value);
        }

        $this->response = $this->client->send($request);
        $this->statusCode = $this->response->getStatusCode();

        return $this->response->json();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $classname = ucwords(str_replace("_", " ", $name));
        $fullclass = "USGS\\" . str_replace(' ', '', $classname);

        if (class_exists($fullclass)) {
            return new $fullclass($this);
        }
    }

    /**
     * @return null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param null $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }


    /**
     * @return string
     */
    public function getUri()
    {
        return $this->baseURI . $this->fdsnWebServiceURI . $this->action;
    }
}
