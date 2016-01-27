<?php

namespace Ballen\Metar\Providers;

/**
 * Metar
 *
 * Metar is a PHP library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including NOAA and VATSIM.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/bobsta63/metar
 * @link http://www.bobbyallen.me
 *
 */
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

    private function getMetarDataString()
    {

        $data = $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));

        // The NOAA web service provides a human readable timestamp of when the report was last generated but we don't care about that so we'll jump to the next line (the actual METAR string)
        $lines = explode($this->icao, $data);
        return trim($this->icao . $lines[1]);
    }

    public function __toString()
    {
        return $this->getMetarDataString();
    }
}
