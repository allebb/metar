<?php

namespace Ballen\Metar\Providers;

interface MetarProviderInterface
{

    function __construct($icao);

    function getMetarDataString();
}
