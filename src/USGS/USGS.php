<?php


namespace USGS;

abstract class USGS implements \Iterator
{
    protected $client = null;
    protected $position = 0;

    public $count = 0;
    public $data  = '';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function load($params = array())
    {
        $json = $this->client->get($this->client->getUri(), $params);

        $this->count = array_key_exists('metadata', $json) ? $json['metadata']['count'] : $json['count'];
        $this->data = array_key_exists('features', $json) ? $json['features'] : [];

        return $this;
    }

    public function setAction($action)
    {
        $this->client->setAction($action);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->data[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    public function count()
    {
        return $this->count;
    }
}