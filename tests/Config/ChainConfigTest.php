<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/26
 * Time: 12:55
 */

namespace Pinfort\wavesPHP\Tests\Config;

use Pinfort\wavesPHP\Config\ChainConfig;
use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Config\Config;

class ChainConfigTest extends TestCase
{

    /**
     * test for set chain
     * @return void
     */
    public function testSetChain(): void
    {
        Config::reset();
        ChainConfig::setChain('mainnet');
        $this->assertEquals(Config::get('chain.CHAIN'), 'mainnet');
        $this->assertEquals(Config::get('chain.CHAIN_ID'), 'W');

        Config::reset();
        ChainConfig::setChain('w');
        $this->assertEquals('mainnet', Config::get('chain.CHAIN'));
        $this->assertEquals('W', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('W');
        $this->assertEquals('mainnet', Config::get('chain.CHAIN'));
        $this->assertEquals('W', Config::get('chain.CHAIN'));

        Config::reset();
        ChainConfig::setChain('hacknet');
        $this->assertEquals('hacknet', Config::get('chain.CHAIN'));
        $this->assertEquals('U', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('u');
        $this->assertEquals('hacknet', Config::get('chain.CHAIN'));
        $this->assertEquals('U', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('U');
        $this->assertEquals('hacknet', Config::get('chain.CHAIN'));
        $this->assertEquals('U', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('testnet');
        $this->assertEquals('testnet', Config::get('chain.CHAIN'));
        $this->assertEquals('T', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('t');
        $this->assertEquals('testnet', Config::get('chain.CHAIN'));
        $this->assertEquals('T', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('testnet', 'W');
        $this->assertEquals('testnet', Config::get('chain.CHAIN'));
        $this->assertEquals('W', Config::get('chain.CHAIN_ID'));

        Config::reset();
        ChainConfig::setChain('foonet', 'F');
        $this->assertEquals('foonet', Config::get('chain.CHAIN'));
        $this->assertEquals('F', Config::get('chain.CHAIN_ID'));

        Config::reset();
    }
}
