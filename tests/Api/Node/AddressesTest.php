<?php

namespace Pinfort\wavesPHP\Tests\Api\Node;

use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Api\Node\Addresses;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Tests\Http\Api;

class AddressesTest extends TestCase
{

    /**
     * Test FetchAllDataByAddress.
     * @return void
     */
    public function testFetchAllDataByAddress()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test FetchAddresses.
     * @return void
     */
    public function testFetchAddresses()
    {
        $addresses = new Addresses(new Api());
        $actual = $addresses->fetchAddresses();
        $this->assertEquals(Config::get('fakeResponses.GET')['/addresses'], $actual);

        $actual = $addresses->fetchAddresses(0, 3);
        $this->assertEquals(Config::get('fakeResponses.GET')['/addresses/seq/0/3'], $actual);

        $this->expectException(\InvalidArgumentException::class);
        $addresses->fetchAddresses(1);
    }

    /**
     * Test CreateAddress.
     * @return void
     */
    public function testCreateAddress()
    {
        $this->markTestIncomplete();
    }

    /**
     * Test VerifySignatureByAddress.
     * @return void
     */
    public function testVerifySignatureByAddress()
    {
        $this->markTestIncomplete();
    }
}
