Metar
=====

A PHP library to query airport METAR information, the library can query both VATSIM (for flight simulator users) as well as real-world METAR data direct from the National Oceanic and Atmospheric Administration (NOAA) aka. US National Weather service.

    As far as I am aware VATSIM also utilises real-world METAR data too but I'd recommend switching the 'service provider' to NOAA just incase!!

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

// We can then get the standard string like so:-

echo $departureMetar;

// Or we can get 'decoded' information like so:-
echo $departureMetar->ICAO; // Returns the airport ICAO code (in this case 'EGSS')
echo $departureMetar->date;
echo $departureMetar->time;
echo $departureMetar->temp;
echo $departureMetar->dewPoint;
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me]().