<?php

namespace Pinfort\wavesPHP\Tests\Api\Node;

use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Api\Node\Addresses;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Tests\Http\Api;
use InvalidArgumentException;

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

        try {
            $addresses->fetchAddresses(1);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('FromIndex and toIndex wants each other. must not be null.', $e->getMessage());
        }

        try {
            $addresses->fetchAddresses(null, 1);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('FromIndex and toIndex wants each other. must not be null.', $e->getMessage());
        }
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
