<?php

namespace Ballen\Metar\Providers;

/**
 * Metar
 *
 * Metar is a PHP 5.4+ library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including NOAA and VATSIM.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/bobsta63/metar
 * @link http://www.bobbyallen.me
 *
 */
use \Ballen\Metar\Providers\MetarProviderInterface;
use \Ballen\Metar\Helpers\MetarHTTPClient;

/**
 * METAR service provided by VATSIM.net
 * @link http://www.vatsim.net or http://metar.vatsim.net/search_metar.php
 */
class Vatsim extends MetarHTTPClient implements MetarProviderInterface
{

    private $serviceUrl = 'http://metar.vatsim.net/metar.php?id={{_ICAO_}}';
    private $icao;

    public function __construct($icao)
    {
        $this->icao = $icao;
    }

    private function getMetarDataString()
    {
        $data = $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));

        // Lets clean up the data...
        $data = trim($data);

        return $data;
    }

    public function __toString()
    {
        return $this->getMetarDataString();
    }

}
