<?php

namespace Ballen\Metar;

class Metar
{

    /**
     * Array of avaliable METAR service URLs
     * @var type 
     */
    private $metarServices = [
        'NOAA' => 'Ballen\Metar\Providers\Noaa',
        'VATSIM' => 'Ballen\Metar\Providers\Vatsim',
    ];

    /**
     * The METAR service of which to use to provide the METAR report.
     * @var string
     */
    private $metarProvider = 'NOAA';

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



        $metar = new $this->metarServices[$this->metarProvider]($icao);
        $this->metar = $metar->getMetarDataString();
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
