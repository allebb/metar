<?php

declare(strict_types=1);

namespace Ballen\Metar\Providers;

/**
 * Metar
 *
 * Metar is a PHP library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including  NOAA, VATSIM and IVAO.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/allebb/metar
 * @link http://www.bobbyallen.me
 *
 */
interface MetarProviderInterface
{
    public function __construct(string $icao);

    public function __toString();

    public function raw() : string;
}
