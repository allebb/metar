Metar
=====

[![Build](https://github.com/allebb/metar/workflows/build/badge.svg)](https://github.com/allebb/metar/actions)
[![Code Coverage](https://codecov.io/gh/allebb/metar/branch/master/graph/badge.svg)](https://codecov.io/gh/allebb/metar)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/allebb/metar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/allebb/metar/?branch=master)
[![Code Climate](https://codeclimate.com/github/allebb/metar/badges/gpa.svg)](https://codeclimate.com/github/allebb/metar)
[![Latest Stable Version](https://poser.pugx.org/ballen/metar/v/stable)](https://packagist.org/packages/ballen/metar)
[![Latest Unstable Version](https://poser.pugx.org/ballen/metar/v/unstable)](https://packagist.org/packages/ballen/metar)
[![License](https://poser.pugx.org/ballen/metar/license)](https://packagist.org/packages/ballen/metar)

A PHP library to query aerodrome METAR information, the library queries real-world METAR data direct from the National Oceanic and Atmospheric Administration (NOAA) and optionally for VATSIM or IVAO.

__The default provider that is configured by this library is NOAA, if you decide to change the provider to VATSIM or IVAO you SHOULD NOT use it for real-world METAR reports.__

Requirements
------------

* PHP >= 7.3.0
* cURL

This library is unit tested against PHP 7.3, 7.4, 8.0, 8.1 and 8.2!

If you need to use an older version of PHP, you should instead install the 2.x version of this library (see below for details).

License
-------

This client library is released under the [GPLv3](https://raw.githubusercontent.com/allebb/metar/master/LICENSE) license, you are welcome to use it, improve it and contribute your changes back!

Installation
------------

The recommended way of installing this library is via. [Composer](http://getcomposer.org); To install using Composer type the following command at the console:

```shell
composer require ballen/metar
```

**If you need to use an older version of PHP, version 2.x.x supports PHP 5.6, 7.0, 7.1 and 7.2, you can install this version using Composer with this command instead:**

```shell
composer require ballen/metar ^2.0
```

Example usage
-------------

```php
use Ballen\Metar\Metar;

/**
 * Using the default options, the report will be retrieved from the NOAA web service.
 */
$egss = new Metar('EGSS');
echo sprintf('The METAR report for Stansted (EGSS) is: %s', $egss);

/**
 * Alternatively, Flight simulation enthusiasts may wish to retrieve the current VATSIM reports,
 * this can be achieved by changing the default provider like so: 
 */
$egss->setProvider(Ballen\Metar\Providers\Vatsim::class);

/**
* Since version 2.1.0, users can now query the IVAO web service for METARs too by using the 'IVAO' provider method like so:
*/
$egss->setProvider(Ballen\Metar\Providers\Ivao::class);
```

Tests and coverage
------------------

This library is fully unit tested using [PHPUnit](https://phpunit.de/).

I use [GitHub Actions](https://github.com/) for continuous integration, which triggers tests for PHP 7.3, 7.4, 8.0, 8.1 and 8.2 every time a commit is pushed.

If you wish to run the tests yourself you should run the following:

```shell
# Install the Metar Library (which will include PHPUnit as part of the require-dev dependencies)
composer install

# Now we run the unit tests (from the root of the project) like so:
./vendor/bin/phpunit
```

Code coverage can also be run and a report generated (this does require XDebug to be installed)...

```shell
./vendor/bin/phpunit --coverage-html ./report
```

Support
-------

I am happy to provide support via. my personal email address, so if you need a hand drop me an email at: [ballen@bobbyallen.me]().
