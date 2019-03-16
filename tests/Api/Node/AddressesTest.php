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
        $addresses = new Addresses(new Api());
        $actual = $addresses->fetchAllDataByAddress('3PM1fmuMNZPntnHQLBaC8bKpJXUjuEmCRx5');
        $this->assertEquals(Config::get('fakeResponses.GET')['/addresses/data/3PM1fmuMNZPntnHQLBaC8bKpJXUjuEmCRx5'], $actual);
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
        $addresses = new Addresses(new Api());
        $actual = $addresses->createAddress();
        $this->assertEquals(Config::get('fakeResponses.POST')['/addresses'], $actual);
    }
}
