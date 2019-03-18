<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/18
 * Time: 14:38
 */

namespace Pinfort\wavesPHP\Tests\Api\Node;

use Pinfort\wavesPHP\Api\Node\Block;
use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Tests\Http\Api;

class BlockTest extends TestCase
{

    /**
     * test for fetchLastBlock
     * @return void
     */
    public function testFetchLastBlock(): void
    {
        $block = new Block(new Api());
        $actual = $block->fetchLastBlock();
        $this->assertEquals($actual, Config::get('fakeResponses.GET')['/blocks/last']);
    }

    /**
     * test for fetchHeight
     * @return void
     */
    public function testFetchHeight(): void
    {
        $block = new Block(new Api());
        $actual = $block->fetchHeight();
        $this->assertEquals($actual, Config::get('fekeResponses.GET')['/blocks/height']['height']);
    }

    /**
     * test for fetch by height
     * @return void
     */
    public function testFetchByHeight(): void
    {
        $block = new Block(new Api());
        $actual = $block->fetchByHeight(1442531);
        $this->assertEquals($actual, Config::get('fakeResponses.GET')['/blocks/at/1442531']);
    }
}
