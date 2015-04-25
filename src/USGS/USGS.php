<?php

namespace USGS;

/**
 * Class USGS
 * @package USGS
 */
/**
 * Class USGS
 * @package USGS
 */
abstract class USGS implements \Iterator
{
    /**
     * @var null|Client
     */
    protected $client = null;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var int
     */
    public $count = 0;

    /**
     * @var string
     */
    public $data  = '';

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

        if (array_key_exists('eventid', $this->params)) {
            $this->data = $this->getDetails($json);
        } else {
            $this->count = array_key_exists('metadata', $json) ? $json['metadata']['count'] : $json['count'];
            $this->data = $this->getFeatures($json);
        }

        return $this;
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
     * @param $json
     * @return array
     */
    public function getFeatures($json)
    {
        return array_key_exists('features', $json) ? $json['features'] : [];
    }

    /**
     * @param $json
     * @return array
     */
    public function getDetails($json)
    {
        return array_key_exists('properties', $json) ? $json['properties'] : [];
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     *
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->count;
    }
}
