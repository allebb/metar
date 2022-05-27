<?php

declare(strict_types=1);

namespace Ballen\Metar\Helpers;

use GuzzleHttp\Client as HttpClient;
use \Exception;
use Psr\Http\Message\StreamInterface;

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
class MetarHTTPClient
{

    /**
     * Optional Guzzle Client configuration.
     * @var array
     */
    protected $guzzleConf = [];

    /**
     * HTTP Client
     * @param array $config Optional Guzzle configuration.
     */
    public function __construct(array $config = [])
    {
        $this->guzzleConf = $config;
    }

    /**
     * Make a HTTP request and retrieve the body.
     * @param string $url The URL to request
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMetarAPIResponse(string $url): string
    {
        $client = new HttpClient($this->guzzleConf);
        $response = $client->get($url);
        return $response->getBody()
                ->getContents();
    }
}
