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
        Config::reset();

        // normal
        Config::set('node.NODE', 'https://connectiontest.dev');
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->post('/example.json');
        $this->assertEquals('POST', $res['request']['method']);
        $this->assertEquals('example.json', $res['request']['url']['path']);

        Config::reset();

        // use host param instead of node.NODE
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->post('/example.json', null, 'https://connectiontest.dev');
        $this->assertEquals('POST', $res['request']['method']);
        $this->assertEquals('example.json', $res['request']['url']['path']);

        Config::reset();

        // path starts with no slash
        Config::set('node.NODE', 'https://connectiontest.dev');
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->post('example.json');
        $this->assertEquals('POST', $res['request']['method']);
        $this->assertEquals('example.json', $res['request']['url']['path']);

        Config::reset();

        // OFFLINE
        Config::set('general.ONLINE', false);
        $api = new Api();
        $res = $api->post('example.json');
        $this->assertEquals('POST', $res['api-type']);
        $this->assertEquals('example.json', $res['api-endpoint']);
        $this->assertEquals(null, $res['api-data']);

        Config::reset();

        // has post data
        Config::set('node.NODE', 'https://connectiontest.dev');
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->post('example.json', ['test' => 'this is test', 'test2' => 1]);
        $this->assertEquals(['test' => 'this is test', 'test2' => '1'], $res['request']['params']);

        Config::reset();
    }

    public function testGet()
    {
        Config::reset();

        // normal
        Config::set('node.NODE', 'https://gist.githubusercontent.com');
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->get('/pinfort/813fe86b0337495d0399fae4289a474e/raw/c0ccf4d823f69fda3d09a0f29b0c45b83a1eaeff/example.json');
        $this->assertEquals([ "name" => "John", "age" => 30, "car" => null ], $res);

        Config::reset();

        // use host param instead of node.NODE
        Config::set('general.ONLINE', true);
        $api = new Api();
        $res = $api->get('/pinfort/813fe86b0337495d0399fae4289a474e/raw/c0ccf4d823f69fda3d09a0f29b0c45b83a1eaeff/example.json', 'https://gist.githubusercontent.com');
        $this->assertEquals([ "name" => "John", "age" => 30, "car" => null ], $res);

        Config::reset();

        // path not starts with slash
        Config::set('general.ONLINE', true);
        Config::set('node.NODE', 'https://gist.githubusercontent.com');
        $api = new Api();
        $res = $api->get('pinfort/813fe86b0337495d0399fae4289a474e/raw/c0ccf4d823f69fda3d09a0f29b0c45b83a1eaeff/example.json');
        $this->assertEquals([ "name" => "John", "age" => 30, "car" => null ], $res);

        Config::reset();

        // OFFLINE
        Config::set('general.ONLINE', false);
        $api = new Api();
        $res = $api->get('example.json');
        $this->assertEquals('GET', $res['api-type']);
        $this->assertEquals('example.json', $res['api-endpoint']);
        $this->assertEquals(null, $res['api-data']);

        Config::reset();
    }
}
