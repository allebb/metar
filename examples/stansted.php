<?php

require '../vendor/autoload.php';

use Ballen\Metar\Metar;

$stansted = new Metar('EGKK');
echo 'METAR: ' . $stansted . ' published ' .$stansted->getPublishedDate();
