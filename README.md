A wrapper for the USGS API
==========================
This is a wrapper for the [USGS API](http://earthquake.usgs.gov/fdsnws/event/1/ "United States Geological Survey").

A few examples
--------------
### Get all 2.5 magnitude or greater quakes in the last hour
    $earthQuake= new EarthQuake(new \GuzzleHttp\Client());
    
    $quakes = $quake->getLastHour(2.5);

### Get all 2.5 magnitude or greater quakes in the last 24 hours
    $earthQuake= new EarthQuake(new \GuzzleHttp\Client());
    
    $quakes = $quake->getLastTwentyFour(2.5);

### Get all 2.5 magnitude or greater quakes in the last 30 days
    $earthQuake= new EarthQuake(new \GuzzleHttp\Client());
    
    $quakes = $quake->getLastThirtyDays(2.5);

### Or build your own!
    $earthQuake= new EarthQuake(new \GuzzleHttp\Client());

    $quakes = $earthQuake
        ->setParams([
            'format' => 'geojson',
            'starttime' => Carbon::now('UTC')->subDays(30)->toIso8601String(),
            'endtime' => Carbon::now('UTC')->toIso8601String(),
            'minmagnitude' => 4
        ])
        ->getQuakes();
