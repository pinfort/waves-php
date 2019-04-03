<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/04/03
 * Time: 14:40
 */

namespace Pinfort\wavesPHP\Tests\Config;

use Pinfort\wavesPHP\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    public function testGetAll()
    {
        Config::reset();
        $config = Config::getAll();
        $this->assertEquals([
            'CHAIN' => 'mainnet',
            'CHAIN_ID' => 'W',
        ], $config['chain']);
    }
}
