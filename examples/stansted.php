<?php

require '../vendor/autoload.php';

use Ballen\Metar\Metar;

$stansted = new Metar('EGSS');

// By default the class will query info from real-world 'NOAA' however if using on VATSIM network you
// may wish to query VATSIM instead to ensure you are using the same as the network.
$stansted->setProvider('VATSIM');

echo 'METAR information for London Stansted: ' . $stansted;
