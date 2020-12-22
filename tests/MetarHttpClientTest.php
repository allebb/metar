<?php
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
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
class MetarHttpClientTest extends TestCase
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
     * Test recieving a METAR report.
     */
    public function testDownloadReport()
    {
        $mock = new MockHandler([
            new Response(200, [], self::EXAMPLE_METAR_REPORT),
        ]);
        $this->handler = HandlerStack::create($mock);
        $client = new Ballen\Metar\Helpers\MetarHTTPClient(['handler' => $this->handler]);
        $this->assertEquals(self::EXAMPLE_METAR_REPORT, $client->getMetarAPIResponse(sprintf(self::VATSIM_SERVICE_URL, 'EGSS')));
    }

    /**
     * Test recieving an invalid report.
     */
    public function testInvalidReport()
    {
        $mock = new MockHandler([
            new Response(404),
        ]);
        $this->handler = HandlerStack::create($mock);
        $client = new Ballen\Metar\Helpers\MetarHTTPClient(['handler' => $this->handler]);
        $this->expectException('Exception', 'Client error: `GET http://metar.vatsim.net/metar.php?id=EGSSA` resulted in a `404 Not Found` response');
        $client->getMetarAPIResponse(sprintf(self::VATSIM_SERVICE_URL, 'EGSSA'));
    }

    /**
     * Test recieving an unprocessable response (eg. a 502 response).
     */
    public function testServiceUnavailableRepsonse()
    {
        $mock = new MockHandler([
            new Response(502),
        ]);
        $this->handler = HandlerStack::create($mock);
        $client = new Ballen\Metar\Helpers\MetarHTTPClient(['handler' => $this->handler]);
        $this->expectException('Exception', 'Server error: `GET http://metar.vatsim.net/metar.php?id=EGSS` resulted in a `502 Bad Gateway`');
        $client->getMetarAPIResponse(sprintf(self::VATSIM_SERVICE_URL, 'EGSS'));
    }
}
