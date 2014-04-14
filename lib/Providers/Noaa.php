<?php

namespace Ballen\Metar\Providers;

use \Ballen\Metar\Providers\MetarProviderInterface;
use \Ballen\Metar\Helpers\MetarHTTPClient;

/**
 * METAR service provided by the US NOAA (National Oceanic and Atmospheric Administration)
 * @link http://www.noaa.gov/
 */

class Noaa extends MetarHTTPClient implements MetarProviderInterface
{

    private $serviceUrl = 'http://weather.noaa.gov/pub/data/observations/metar/stations/{{_ICAO_}}.TXT';
    private $icao;

    public function __construct($icao)
    {
        $this->icao = $icao;
    }

    public function getMetarDataString()
    {
        
        $data = $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));

        // The NOAA web service provides a human readable timestamp of when the report was last generated but we don't care about that so we'll jump to the next line (the actual METAR string)
        $lines = explode($this->icao, $data);
        $data = trim($this->icao . $lines[1]);
        
        return $data;
    }

}
