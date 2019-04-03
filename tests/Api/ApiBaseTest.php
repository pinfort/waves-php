<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/04/03
 * Time: 14:30
 */

namespace Pinfort\wavesPHP\Tests\Api;

use Pinfort\wavesPHP\Api\ApiBase;
use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Api\Node\Addresses;
use Pinfort\wavesPHP\Config\Config;

class ApiBaseTest extends TestCase
{

    public function testConstruct()
    {
        Config::reset();
        Config::set('general.ONLINE', false);
        $addresses = new Addresses();
        $res = $addresses->fetchAddresses();
        $this->assertEquals('/addresses', $res['api-endpoint']);
        Config::reset();
    }
}
