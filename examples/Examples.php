<?php
require_once '../vendor/autoload.php';

use Ballen\Metar\Metar;

/**
 * Using the default options, the report will be retrieved from the NOAA web service.
 */
$egss = new Metar('EGSS');
echo sprintf('The METAR report for Stanstead (EGSS) is: %s', $egss);

/**
 * Alternatively, Flight simulation enthusiates may wish to retrieve the current VATSIM reports,
 * this can be achieved by 
 */
$leib = new Metar('LEIB');
$leib->setProvider('VATSIM');
echo sprintf('The VATSIM METAR report for Ibiza airport (LEIB) is: %s', $leib);

