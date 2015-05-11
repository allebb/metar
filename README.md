Metar
=====

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bobsta63/metar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/metar/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bobsta63/metar/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/metar/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bobsta63/metar/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bobsta63/metar/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/ballen/metar/v/stable)](https://packagist.org/packages/ballen/metar)
[![Latest Unstable Version](https://poser.pugx.org/ballen/metar/v/unstable)](https://packagist.org/packages/ballen/metar)
[![License](https://poser.pugx.org/ballen/metar/license)](https://packagist.org/packages/ballen/metar)

A PHP library to query airport METAR information, the library queries real-world METAR data direct from the National Oceanic and Atmospheric Administration (NOAA) aka. US National Weather service.

> As far as I am aware VATSIM also utilises real-world METAR data too but I'd recommend switching the 'service provider' to NOAA just incase!!

Requirements
------------

* PHP >= 5.4.x
* cURL

License
-------

This client library is released under the GPLv3 license, you are welcome to use it, improve it and contribute your changes back!

Examples
--------

```php

use Ballen\Metar;

$departureMetar = new Metar('EGSS'); // Request METAR object for London Stansted (EGSS)
$arrivalMetar = new Metar('LEIB'); // Request METAR object for Ibiza (LEIB)

// We can then get the standard METAR string like so:-
echo $departureMetar;
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me]().