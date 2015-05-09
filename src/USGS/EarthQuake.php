<?php


namespace USGS;

use Carbon\Carbon;

/**
 * Class EarthQuake
 * @package USGS
 */
class EarthQuake extends USGS
{
    /**
     * @param $minMagnitude
     * @return $this
     */
    public function getLastHour($minMagnitude)
    {
        $this->addParams(
            [
                'format' => 'geojson',
                'starttime' => Carbon::now('UTC')->subHour(),
                'endtime' => Carbon::now('UTC'),
                'minmagnitude' => $minMagnitude
            ]
        );

        return $this->getQuakes();
    }

    /**
     * @param $minMagnitude
     * @return $this
     */
    public function getLastTwentyFour($minMagnitude)
    {
        $this->addParams(
            [
                'format' => 'geojson',
                'starttime' => Carbon::now('UTC')->subDay(),
                'endtime' => Carbon::now('UTC'),
                'minmagnitude' => $minMagnitude
            ]
        );

        return $this->getQuakes();
    }

    /**
     * @param $minMagnitude
     * @return $this
     */
    public function getLastThirtyDays($minMagnitude)
    {
        $this->addParams(
            [
                'format' => 'geojson',
                'starttime' => Carbon::now('UTC')->subDays(30),
                'endtime' => Carbon::now('UTC'),
                'minmagnitude' => $minMagnitude
            ]
        );

        return $this->getQuakes();
    }

    /**
     * @param string $action
     * @return $this
     */
    public function getQuakes($action = 'query')
    {
        $this->setAction($action);

        return $this->load()->getPayLoad();
    }
}
