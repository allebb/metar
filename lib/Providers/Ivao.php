<?php

declare(strict_types=1);

namespace Ballen\Metar\Providers;

/**
 * Metar
 *
 * Metar is a PHP library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including NOAA, VATSIM and IVAO.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/allebb/metar
 * @link http://www.bobbyallen.me
 *
 */
use \Ballen\Metar\Helpers\MetarHTTPClient;

/**
 * METAR service provided by the IVAO (The International Virtual Aviation Organisation)
 * @link https://www.ivao.aero/
 */
class Ivao extends MetarHTTPClient implements MetarProviderInterface
{
    private $serviceUrl = 'http://wx.ivao.aero/metar.php/?id={{_ICAO_}}';
    private $icao;

    public function __construct(string $icao)
    {
        $this->icao = $icao;
    }

    /**  @throws \GuzzleHttp\Exception\GuzzleException */
    private function getMetarDataString(): string
    {
        return $this->getMetarAPIResponse(str_replace('{{_ICAO_}}', $this->icao, $this->serviceUrl));
    }

    public function __toString(): string
    {
        return $this->getMetarDataString();
    }
}
