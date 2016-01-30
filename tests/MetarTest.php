<?php
use Ballen\Metar\Metar;

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
class MetarTest extends \PHPUnit_Framework_TestCase
{

    public function testSetValidIcao()
    {
        $metar = new Metar('EGSS');
    }

    public function testSetInvalidIcao()
    {
        $this->setExpectedException('InvalidArgumentException', 'ICAO code does not appear to be a valid format');
        $metar = new Metar('EGSSA');
    }

    public function testSetValidProvider()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider('Noaa');
    }

    public function testSetInvalidProvider()
    {
        $metar = new Metar('EGSS');
        $this->setExpectedException('InvalidArgumentException', 'The service provider your specified does not exist in the namespace \'' . Metar::SERVICES_NAMESPACE . '\'');
        $metar->setProvider('An_Invalid_Provider');
    }

    public function testValidNoaaMetarResponse()
    {
        $metar = new Metar('EGSS');
        $check_valid_metar = strpos($metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }
    
    public function testValidVatsimMetarResponse()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider('Vatsim');
        $check_valid_metar = strpos($metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }
}
