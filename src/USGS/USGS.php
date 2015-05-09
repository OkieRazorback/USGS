<?php

namespace USGS;

/**
 * Class USGS
 * @package USGS
 */
class USGS
{
    /**
     * @var null|Client
     */
    protected $client = null;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @var string
     */
    protected $payLoad  = '';

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return $this
     */
    public function load()
    {
        $json = $this->client->get($this->client->getUri(), $this->params);

        $this->count = array_key_exists('metadata', $json) ? $json['metadata']['count'] : $json['count'];
        $this->payLoad = $json;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->client->setAction($action);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param array $params
     */
    public function addParams(array $params)
    {
        foreach ($params as $key => $value) {
            $this->addParam($key, $value);
        }
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getPayLoad()
    {
        return $this->payLoad;
    }
}
