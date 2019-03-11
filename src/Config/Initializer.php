<?php

namespace Pinfort\wavesPHP\Config;

use Pinfort\wavesPHP\Config;

class Initializer
{
    private static $values_directory = __DIR__ . '/values/';

    private static function register(string $key, $value): void
    {
        Config::set($key, $value);
    }

    private static function getFileNames()
    {
        return glob(self::$values_directory . '*.php');
    }

    public static function initialize()
    {
        foreach (self::getFileNames() as $target) {
            $values = include $target;
            $filename = basename($target, '.php');
            foreach ($values as $key => $value) {
                self::register($filename . '.' . $key, $value);
            }
        }
    }
}
