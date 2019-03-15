<?php

namespace Pinfort\wavesPHP\Tests\Http;

use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Http\ApiInterface;

/**
 * Api class for test
 * @package Pinfort\wavesPHP\Test
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category TestHttp
 */
class Api implements ApiInterface
{
    /**
     * Return fake GET response for test.
     * @param string $path Path to access. It must be start with slash.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return array
     */
    public function get(string $path, ?string $host = null, array $headers = []): array
    {
        return Config::get('fakeResponses.GET')[$path];
    }

    /**
     * Return fake POST response for test.
     * @param string $path Path to access. It must be start with slash.
     * @param array|null $postData Input Data to post. Key-value style.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return array
     */
    public function post(string $path, ?array $postData = null, ?string $host = null, array $headers = []): array
    {
        return Config::get('fakeResponses.POST')[$path];
    }
}