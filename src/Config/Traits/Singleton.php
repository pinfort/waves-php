<?php

namespace Pinfort\wavesPHP\Config\Traits;

use \RuntimeException;

/**
 * This trait define singleton pattern.
 *
 * Deny creation many instances
 * PHP Version = 7.2.8(Tested on)
 *
 * @category Traits
 * @author  pinfort <ptg@nijitei.com>
 * @license https://opensource.org/licenses/mit-license.html MIT License
 * @see https://eddmann.com/posts/accessors-getter-setter-and-singleton-traits-in-php/
 */
trait Singleton
{
    /**
     * @var Singleton Save instance for singleton.
     */
    private static $instance;

    /**
     * Singleton constructor.
     */
    private function __construct()
    {
    }

    /**
     * Get saved instance for singleton.
     * @return Singleton
     */
    final private static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * deny override
     * @throws RuntimeException Deny clone instance.
     * @return void
     */
    final private function __clone()
    {
        throw new RuntimeException("You can't clone this instance.");
    }
}
