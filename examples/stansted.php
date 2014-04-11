<?php

require '../vendor/autoload.php';

use Ballen\Metar\Metar;

$stansted = new Metar('EGSS');

echo 'METAR: ' . $stansted . ' published ' . $stansted->getPublishedDate();
