<?php
use \PHPUnit_Framework_TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

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
class MetarHttpClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * Example report data that we expect to recieve.
     */
    const EXAMPLE_METAR_REPORT = 'EGSS 272020Z AUTO 27009KT 240V310 9999 BKN044 08/04 Q1010';
    
    /**
     * Example service URL
     */
    const VATSIM_SERVICE_URL = "http://metar.vatsim.net/metar.php?id=%s";

    /**
     * The Mock Handler for the Guzzle Client.
     * @var HandlerStack
     */
    private $handler;

    /**
     * Setup the testcase
     */
    public function setUp()
    {
        $mock = new MockHandler([
            new Response(200, [], self::EXAMPLE_METAR_REPORT),
        ]);
        $this->handler = HandlerStack::create($mock);
    }

    /**
     * Test recieving a METAR report.
     */
    public function testDownloadReport()
    {
        $client = new Ballen\Metar\Helpers\MetarHTTPClient(['handler' => $this->handler]);
        $this->assertEquals(self::EXAMPLE_METAR_REPORT, $client->getMetarAPIResponse(sprintf(self::VATSIM_SERVICE_URL, 'EGSS')));
    }
}
