<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/26
 * Time: 13:16
 */

namespace Pinfort\wavesPHP\Tests\Config;

use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Config\NodeConfig;
use PHPUnit\Framework\TestCase;

class NodeConfigTest extends TestCase
{

    /**
     * test for get node
     * @return void
     */
    public function testGetNode(): void
    {
        $actual = NodeConfig::getNode();
        $this->assertEquals(Config::get('node.NODE'), $actual);
        Config::reset();
    }

    /**
     * test for set node
     * @return void
     */
    public function testSetNode(): void
    {
        NodeConfig::setNode('https://testnode2.wavesnodes.com', 'testnet');
        $this->assertEquals('https://testnode2.wavesnodes.com', Config::get('node.NODE'));
        Config::reset();
    }
}
