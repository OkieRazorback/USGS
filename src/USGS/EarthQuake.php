<?php


namespace USGS;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

/**
 * Class EarthQuake
 * @package USGS
 */
class EarthQuake extends USGS
{
    /**
     * Return all quakes last hour
     *
     * Return all the quakes greater than or equal to the minimum
     * magnitude from the last hour.
     *
     * @param $minMagnitude
     * @return string
     */
    public function getLastHour($minMagnitude)
    {
        $this->setParams([
            'format' => 'geojson',
            'starttime' => Carbon::now('UTC')->subHour()->toIso8601String(),
            'endtime' => Carbon::now('UTC')->toIso8601String(),
            'minmagnitude' => $minMagnitude
        ]);

        return $this->getQuakes();
    }

    /**
     * Return all quakes last twenty four hours
     *
     * Return all the quakes greater than or equal to the minimum
     * magnitude from the twenty four hours.
     *
     * @param $minMagnitude
     * @return $this
     */
    public function getLastTwentyFour($minMagnitude)
    {
        $this->setParams([
            'format' => 'geojson',
            'starttime' => Carbon::now('UTC')->subDay()->toIso8601String(),
            'endtime' => Carbon::now('UTC')->toIso8601String(),
            'minmagnitude' => $minMagnitude
        ]);

        return $this->getQuakes();
    }

    /**
     * Return all quakes last thirty days
     *
     * Return all the quakes greater than or equal to the minimum
     * magnitude from the last thirty days.
     *
     * @param $minMagnitude
     * @return $this
     */
    public function getLastThirtyDays($minMagnitude)
    {
        $this->setParams([
            'format' => 'geojson',
            'starttime' => Carbon::now('UTC')->subDays(30)->toIso8601String(),
            'endtime' => Carbon::now('UTC')->toIso8601String(),
            'minmagnitude' => $minMagnitude
        ]);

        return $this->getQuakes();
    }

    /**
     * @return string
     */
    public function getQuakes()
    {
        return $this->getRequest('query')->getPayload();
    }
}
