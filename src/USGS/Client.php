<?php


namespace USGS;

use GuzzleHttp;

class Client
{
    protected $baseURI = 'http://earthquake.usgs.gov';
    protected $fdsnWebServiceURI = '/fdsnws/event/1/';
    protected $client = null;
    protected $action = null;
    protected $request = null;

    public $response = null;
    public $statusCode = null;
    public $detail = null;

    public function __construct($httpClient = null)
    {
        $this->client = (is_null($httpClient)) ? new GuzzleHttp\Client() : $httpClient;
    }

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


    public function getUri()
    {
        return $this->baseURI . $this->fdsnWebServiceURI . $this->action;
    }
}