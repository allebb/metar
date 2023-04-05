<?php

declare(strict_types=1);

use Ballen\Metar\Metar;
use PHPUnit\Framework\TestCase;

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
class MetarTest extends TestCase
{

    /**
     * Test requesting of a valid ICAO code (does not throw an invalid formation exception)
     */
    public function testSetValidIcao()
    {
        $metar = new Metar('EGSS');
        $this->assertTrue(true); // Assert that NO exception was previously thrown (eg. the ICAO code was valid) in this test case!
    }

    /**
     * Tests requesting an invalid ICAO code (throws correct exception)
     */
    public function testSetInvalidIcao()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('ICAO code does not appear to be a valid format');
        $metar = new Metar('EGSSA');
    }

    /**
     * Tests settings a valid METAR provider service (Provider class exists)
     */
    public function testSetValidProvider()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider(\Ballen\Metar\Providers\Noaa::class);
        $this->assertTrue(true); // Assert that NO exception was previously thrown (eg. the ICAO code was valid) in this test case!
    }

    /**
     * Tests setting an invalud provider service (The provider class does not exist)
     */
    public function testSetInvalidProvider()
    {
        $metar = new Metar('EGSS');
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('The service provider your specified does not exist in the namespace \'An_Invalid_Provider\'');
        $metar->setProvider('An_Invalid_Provider');
    }

    /**
     * Test requesting a METAR report using the default NOAA provider.
     */
    public function testValidNoaaMetarResponse()
    {
        $metar = new Metar('EGSS');
        $check_valid_metar = strpos((string)$metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }

    /**
     * Test requesting a METAR report using VATSIM as the provider.
     */
    public function testValidVatsimMetarResponse()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider(Ballen\Metar\Providers\Vatsim::class);
        $check_valid_metar = strpos((string)$metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }

    /**
     * Test requesting a METAR report using IVAO as the provider.
     */
    public function testValidIvaoMetarResponse()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider(Ballen\Metar\Providers\Ivao::class);
        $check_valid_metar = strpos($metar->report()->raw(), 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }
}
