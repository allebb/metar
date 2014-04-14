<?php

namespace Ballen\Metar\Providers;

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

    public function getMetarDataString()
    {
        $data = $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));

        // Lets clean up the data...
        $data = trim($data);

        return $data;
    }

}
