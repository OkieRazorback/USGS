<?php

namespace USGS;

use GuzzleHttp;

/**
 * Class USGS
 * @package USGS
 */
class USGS
{
    const BASE_URI = 'http://earthquake.usgs.gov/fdsnws/event/1/';

    /**
     * @var GuzzleHttp\Client|null
     */
    private $client = null;

    /**
     * @var GuzzleHttp\Psr7\Response|null
     */
    private $response = null;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @param GuzzleHttp\Client $client
     */
    public function __construct(GuzzleHttp\Client $client) {
        $this->client = $client;
    }

    /**
     * @param $method Type of request to USGS service [query|count|version]
     * @return $this
     */
    public function getRequest($method)
    {
        $this->response = $this->client->get(
            self::BASE_URI . $method,
            [
                'query' => $this->params,
            ]
        );

        return $this;
    }

    /**
     * @param $params
     * @return $this
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayload() {
        return $this->response->getBody()->getContents();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
