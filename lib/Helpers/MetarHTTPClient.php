<?php

namespace Ballen\Metar\Helpers;

use GuzzleHttp\Client as HttpClient;
use \Exception;

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
