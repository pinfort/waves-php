<?php

namespace Pinfort\wavesPHP\Api;

use Pinfort\wavesPHP\Config\NodeConfig;
use Pinfort\wavesPHP\Config\Config;
use GuzzleHttp;

class ApiBase
{
    protected static function get(string $path, ?string $host = null, array $headers = [])
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        $client = new GuzzleHttp\Client();

        $res = $client->get($host.$path, ['headers' => $headers]);

        return json_decode($res->getBody());
    }

    protected static function post(string $path, ?array $postData = null, ?string $host = null, array $headers = [])
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path, $postData);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        $client = new GuzzleHttp\Client();

        if (is_null($postData)) {
            $res = $client->post($host.$path, ['headers' => array_merge(['content-type' => 'application/json'], $headers)]);
        } else {
            $res = $client->post($host.$path, ['form_params' => $postData, 'headers' => array_merge(['content-type' => 'application/json'], $headers)]);
        }

        return json_decode($res->getBody());
    }

    private static function makeOfflineTx(string $path, ?array $postData = null)
    {
        $offlineTx = [];
        if (!is_null($postData)) {
            $offlineTx['api-type'] = 'POST';
        } else {
            $offlineTx['api-type'] = 'GET';
        }
        $offlineTx['api-endpoint'] = $path;
        $offlineTx['api-data'] = $postData;

        return $offlineTx;
    }
}
