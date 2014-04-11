<?php

namespace Ballen\Metar;

use GuzzleHttp\Client as HttpClient;
use \Exception;

class Metar
{

    /**
     * The date that the NOAA provide as the 'last updated' time.
     * @var type 
     */
    private $publishDate;

    /**
     * The METAR string retrieved from the web service.
     * @var string The raw METAR string retrieved from the web service. 
     */
    private $metar;

    /**
     * Gather METAR infomation for a given ICAO code.
     * @param string $icao Four-digital ICAO airport code.
     * @throws \InvalidArgumentException
     */
    public function __construct($icao)
    {

        // We force the format of the ICAO code to be upper case!
        $icao = strtoupper($icao);

        // Validate the ICAO code, just check some standard formatting stuff really!
        $this->validateIcao($icao);

        $client = new HttpClient();
        try {
            $response = $client->get('http://weather.noaa.gov/pub/data/observations/metar/stations/' . $icao . '.TXT');
            if ($response->getStatusCode() != 200) {
                throw new Exception('An error occured when attempting to access the remote webservice, please try again shortly!');
            }
        } catch (Exception $ex) {
            die('An exception was caught: ' . $ex->getMessage());
        }

        // The NOAA API provides date infomation too, we don't want this as part of the RAW meta string so'll we'll split this up!
        $lines = explode($icao, $response->getBody());
        //
        // Store the published date.
        $this->publishDate = $lines[0];

        // Store the raw METAR string.
        $metar_string = $icao . ' ' . $lines[1];
        $this->metar = $metar_string;
    }

    /**
     * Returns the string METAR message.
     * @return string The RAW METAR message.
     */
    public function __toString()
    {
        return $this->metar;
    }

    /**
     * Validates the ICAO code to ensure it's format is valid.
     * @param string $icao ICAO code, eg. EGSS
     * @throws \InvalidArgumentException
     */
    private function validateIcao($icao)
    {
        if (strlen($icao) != 4) {
            throw new \InvalidArgumentException('ICAO code does not appear to be a valid format (for example \'EGSS\' for London Stansted!');
        }
    }

    /**
     * Returns the date of when the METAR infomation was last updated.
     * @return string
     */
    public function getPublishedDate()
    {
        return $this->publishDate;
    }

}
