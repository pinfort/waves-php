<?php

namespace Pinfort\wavesPHP\Tests\Api\Node;

use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Api\Node\Addresses;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Tests\Http\Api;

class AddressesTest extends TestCase
{

    public function testFetchAllDataByAddress()
    {
    }

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

    public function testCreateAddress()
    {

    }

    public function testVerifySignatureByAddress()
    {

    }
}
