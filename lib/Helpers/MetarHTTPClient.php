<?php

namespace Ballen\Metar\Helpers;

use GuzzleHttp\Client as HttpClient;
use \Exception;

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
class MetarHTTPClient
{

    /**
     * Optional Guzzle Client configuration.
     * @var array
     */
    protected $guzzle_conf;

    /**
     * HTTP Client
     * @param array $config Optional Guzzle configuration.
     */
    public function __construct($config = [])
    {
        $this->guzzle_conf = $config;
    }

    /**
     * Make a HTTP request and retrieve the body.
     * @param string $url The URL to request
     * @return string
     */
    public function getMetarAPIResponse($url)
    {
        if ($this->guzzle_conf) {
            $client = new HttpClient($this->guzzle_conf);
        } else {
            $client = new HttpClient();
        }
        $response = $client->get($url);
        return $response->getBody();
    }
}
