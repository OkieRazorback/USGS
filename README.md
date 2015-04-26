A wrapper for the USGS API
==========================
This is a wrapper for the [USGS API](http://earthquake.usgs.gov/fdsnws/event/1/ "United States Geological Survey").

A few examples
--------------
### Get all 2.5 magnitude or greater quakes in the last hour
    $quake = new EarthQuake(new Client());
    
    $quakes = $quake->getLastHour(2.5);

### Get all 2.5 magnitude or greater quakes in the last 24 hours
    $quake = new EarthQuake(new Client());
    
    $quakes = $quake->getLastTwentyFour(2.5);

### Get all 2.5 magnitude or greater quakes in the last 30 days
    $quake = new EarthQuake(new Client());
    
    $quakes = $quake->getLastThirtyDays(2.5);

### Or build your own!
    $quake = new EarthQuake(new Client());
    
    $quake->addParams([
        'format' = 'geojson',
        'starttime' => '2015-04-25 13:00:00',
        'endtime' => '2015-04-26 12:59:59',
    ]);
    
    $quake->addParam('minmagnitude', 3);
    
    $quakes = $quake->getQuakes();
