<?php

require '../vendor/autoload.php';

use Ballen\Metar\Metar;

$metar = new Metar('KJFK'); // 'KJFK' is the ICAO code for New York's JFK International Airport.

echo 'METAR information for New York JFK International is: ' . $metar;
