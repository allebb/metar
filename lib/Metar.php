<?php

namespace Ballen\Metar;

class Metar
{

    /**
     * Stores the default namespace for loading new METAR providers from.
     */
    const SERVICES_NAMESPACE = 'Ballen\Metar\Providers';

    /**
     * The METAR service of which to use to provide the METAR report.
     * @var string
     */
    private $metarProvider;

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

        // Set a default provider, can be overrideen with 'setProvider()' function.
        $this->setProvider('NOAA');

        $this->metar = (new $this->metarProvider($icao))->getMetarDataString();
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
     * 
     * @param type $provider
     */
    public function setProvider($provider = 'Noaa')
    {
        if (!class_exists(self::SERVICES_NAMESPACE . '\\' . $provider)) {
            throw new \InvalidArgumentException('The service provider your specified does not exist in the namespace \'' . self::SERVICES_NAMESPACE . '\'');
        }
        $this->metarProvider = self::SERVICES_NAMESPACE . '\\' . $provider;
    }

}
