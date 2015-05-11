<?php namespace Ballen\Metar;

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
class Metar
{

    /**
     * Stores the default namespace for loading new METAR providers from.
     */
    const SERVICES_NAMESPACE = 'Ballen\Metar\Providers';

    /**
     * Stores the requested airfield/port ICAO code.
     * @var string ICAO code.
     */
    private $icao;

    /**
     * The METAR string retrieved from the web service.
     * @var string The raw METAR string retrieved from the web service. 
     */
    private $metar;

    /**
     * The METAR service of which to use to provide the METAR report.
     * @var string METAR data provider class/file name.
     */
    private $metarProvider;

    /**
     * Initiates a new METAR object.
     * @param string $icao The airfeild/airport ICAO code.
     */
    public function __construct($icao)
    {

        // We force the format of the ICAO code to be upper case!
        $this->icao = strtoupper($icao);

        // Validate the ICAO code, just check some standard formatting stuff really!
        $this->validateIcao($this->icao);

        // Set a default provider, can be overrideen with 'setProvider()' function.
        $this->setProvider('Noaa');
    }

    /**
     * Returns the RAW METAR message as a string.
     * @return string The RAW METAR message.
     */
    public function __toString()
    {
        // We'll set the object 'metar' property to the station metar data as well as return the string so
        // that in future we can extend further and use the METAR string in other parts of our class after it has
        // been retrieved!
        return $this->metar = (string) new $this->metarProvider($this->icao);
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
     * Changes the default 'NOAA' METAR service provider to another one eg. 'VATSIM'.
     * @param string $provider METAR Provider Class/File name.
     */
    public function setProvider($provider = 'Noaa')
    {
        if (!class_exists(self::SERVICES_NAMESPACE . '\\' . $provider)) {
            throw new \InvalidArgumentException('The service provider your specified does not exist in the namespace \'' . self::SERVICES_NAMESPACE . '\'');
        }
        $this->metarProvider = self::SERVICES_NAMESPACE . '\\' . $provider;
    }
}
