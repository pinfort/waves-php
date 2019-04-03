<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/04/03
 * Time: 14:47
 */

namespace Pinfort\wavesPHP\Tests\Config\Traits;

use Pinfort\wavesPHP\Config\Traits\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    public function testConstruct()
    {
        try {
            $i = new SingletonUsingClass();
        } catch(\Error $e) {
            $this->assertEquals('Call to private Pinfort\wavesPHP\Tests\Config\Traits\SingletonUsedClass::__construct() from context \'Pinfort\wavesPHP\Tests\Config\Traits\SingletonTest\'', $e->getMessage());
        }
    }

    public function testClone()
    {
        $instance = SingletonUsingClass::passInstance();
        try {
            $i = $instance->cloneInstance();
        } catch(\RuntimeException $e) {
            $this->assertEquals('You can\'t clone this instance.', $e->getMessage());
        }
    }
}

class SingletonUsingClass
{
    use Singleton;

    public static function passInstance()
    {
        return SingletonUsingClass::getInstance();
    }

    public function cloneInstance()
    {
        return clone $this;
    }
}
