# WavesPHP
[![Build Status](https://travis-ci.org/pinfort/waves-php.svg?branch=master)](https://travis-ci.org/pinfort/waves-php) [![Coverage Status](https://coveralls.io/repos/github/pinfort/waves-php/badge.svg?branch=master)](https://coveralls.io/github/pinfort/waves-php?branch=master)

WavesPHP is API clients for Waves blockchain platform written in PHP.

## Installation
*This library is Work in Progress.(not yet on release)*

This library depends on [PHP-blake2](https://github.com/strawbrary/php-blake2) and [curve25519-PHP](https://github.com/mgp25/curve25519-php).
Please install these extensions to your PHP first. Do you want to know how to install PHP extensions to Windows? Below links are useful.

- [Windows で拡張モジュールをビルドしてみた](https://www.slideshare.net/y-uti/windows-60158242)（日本語, Japanese）
- [Compile PHP on Windows](https://www.sitepoint.com/compiling-php-from-source-on-windows/)（英語, English）

*In the future*, this library will be installable like below.

    composer install pinfort/waves-php

## Example usage

    (new \Pinfort\wavesPHP\Api\Node\Addresses())->fetchAddresses();

## Documents

[Link to Documents](https://pinfort.github.io/waves-php/)

## Thanks
Some codes in this library is translated from [PyWaves](https://github.com/PyWaves/PyWaves).
