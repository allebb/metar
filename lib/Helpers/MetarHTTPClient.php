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

    public function getMetarAPIResponse($url)
    {
        $client = new HttpClient();
        try {
            $response = $client->get($url);
            if ($response->getStatusCode() != 200) {
                throw new Exception('An error occured when attempting to access the remote webservice, please try again shortly!');
            }
        } catch (Exception $ex) {
            die('An exception was caught: ' . $ex->getMessage());
        }
        return $response->getBody();
    }
}
