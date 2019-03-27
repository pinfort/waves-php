<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/27
 * Time: 12:47
 */

namespace Pinfort\wavesPHP\Tests\Http;

use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Http\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    public function testPost()
    {
        $this->markTestIncomplete('not implemented');
    }

    public function testGet()
    {
        Config::set('node.NODE', 'https://gist.githubusercontent.com');
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->get('/pinfort/813fe86b0337495d0399fae4289a474e/raw/c0ccf4d823f69fda3d09a0f29b0c45b83a1eaeff/example.json');
        $this->assertEquals([ "name" => "John", "age" => 30, "car" => null ], $res);

        Config::reset();

        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->get('/pinfort/813fe86b0337495d0399fae4289a474e/raw/c0ccf4d823f69fda3d09a0f29b0c45b83a1eaeff/example.json', 'https://gist.githubusercontent.com');
        $this->assertEquals([ "name" => "John", "age" => 30, "car" => null ], $res);
    }
}
