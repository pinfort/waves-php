<?php

namespace Pinfort\wavesPHP\Config;

use Pinfort\wavesPHP\Config\Traits\Singleton;

class Config
{
    use Singleton;

    private $config = [];

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
}

// function setNode($node = null, $chain = null, $chain_id = null)
// {
//     $NODE = $node;
//     $CHAIN = $chain;
//     $CHAIN_ID = $chain_id;
// }
