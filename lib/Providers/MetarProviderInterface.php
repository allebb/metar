<?php namespace Ballen\Metar\Providers;

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
interface MetarProviderInterface
{

    function __construct($icao);

    function __toString();
}
