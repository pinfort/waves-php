<?php

namespace Pinfort\wavesPHP\Config;

use Pinfort\wavesPHP\Config\Traits\Singleton;

/**
 * Configuration management class
 * @package Pinfort\wavesPHP\Config
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Config
 */
class Config
{
    use Singleton;

    /**
     * Configuration array. We save all configurations in this array.
     * @var array
     */
    private $config = [];

    /**
     * Directory path to configuration files.
     * @var string
     */
    private static $valuesDirectory = __DIR__ . '/values/';

    /**
     * Config constructor.
     */
    private function __construct()
    {
        $this->initialize();
    }

    /**
     * Set new config | Update config
     * @param string $key Key to set.
     * @param mixed $value Value to set.
     * @return void
     */
    public static function set(string $key, $value): void
    {
        $config = &self::getInstance()->config;
        $config[$key] = $value;
    }

    /**
     * Get config by key.
     * @param string $key Key to get.
     * @return mixed
     */
    public static function get(string $key)
    {
        $config = self::getInstance()->config;

        return $config[$key];
    }

    /**
     * Get all config.
     * @return array
     */
    public static function getAll(): array
    {
        $config = self::getInstance()->config;

        return $config;
    }

    /**
     * Get name of configuration files.
     * @return array
     */
    private static function getFileNames(): array
    {
        return glob(self::$valuesDirectory . '*.php');
    }

    /**
     * Initialize | Reset configuration.
     * @return void
     */
    private function initialize(): void
    {
        $this->config = [];
        foreach (self::getFileNames() as $target) {
            $values = include $target;
            $filename = basename($target, '.php');
            foreach ($values as $key => $value) {
                $this->config[$filename . '.' . $key] = $value;
            }
        }
    }
}
