Metar
=====

[![Build Status](https://scrutinizer-ci.com/g/bobsta63/metar/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/metar/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bobsta63/metar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/metar/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/ballen/metar/v/stable)](https://packagist.org/packages/ballen/metar)
[![Latest Unstable Version](https://poser.pugx.org/ballen/metar/v/unstable)](https://packagist.org/packages/ballen/metar)
[![License](https://poser.pugx.org/ballen/metar/license)](https://packagist.org/packages/ballen/metar)

A PHP library to query aerodrome METAR information, the library queries real-world METAR data direct from the National Oceanic and Atmospheric Administration (NOAA) and optionally for VATSIM.

__The default provider that is configured by this library is NOAA, if you decide to change the provider to VATSIM you SHOULD NOT use it for real-world METAR reports.__

Requirements
------------

* PHP >= 5.5.0
* cURL

License
-------

This client library is released under the [GPLv3](https://raw.githubusercontent.com/bobsta63/metar/master/LICENSE) license, you are welcome to use it, improve it and contribute your changes back!

Examples
--------

```php
use Ballen\Metar\Metar;

/**
 * Using the default options, the report will be retrieved from the NOAA web service.
 */
$egss = new Metar('EGSS');
echo sprintf('The METAR report for Stansted (EGSS) is: %s', $egss);

/**
 * Alternatively, Flight simulation enthusiasts may wish to retrieve the current VATSIM reports,
 * this can be achieved by 
 */
$leib = new Metar('LEIB');
$leib->setProvider('VATSIM');
echo sprintf('The VATSIM METAR report for Ibiza airport (LEIB) is: %s', $leib);
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me](mailto:ballen@bobbyallen.me).