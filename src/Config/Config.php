<?php

namespace Pinfort\wavesPHP\Config;

use Pinfort\wavesPHP\Config\Traits\Singleton;

class Config
{
    use Singleton;

    private $config = [];
    private static $values_directory = __DIR__ . '/values/';

    private function __construct()
    {
        foreach (self::getFileNames() as $target) {
            $values = include $target;
            $filename = basename($target, '.php');
            foreach ($values as $key => $value) {
                $this->config[$filename . '.' . $key] = $value;
            }
        }
    }

    /**
     * @param string $key
     * @param $value
     */
    public static function set(string $key, $value): void
    {
        $config = &self::getInstance()->config;
        $config[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public static function get(string $key)
    {
        $config = self::getInstance()->config;

        return $config[$key];
    }

    public static function getAll()
    {
        $config = self::getInstance()->config;

        return $config;
    }

    private static function getFileNames()
    {
        return glob(self::$values_directory . '*.php');
    }
}
