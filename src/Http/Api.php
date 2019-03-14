<?php

namespace Pinfort\wavesPHP\Http;

use Pinfort\wavesPHP\Config\NodeConfig;
use Pinfort\wavesPHP\Config\Config;
use GuzzleHttp;

class Api implements ApiInterface
{
    private $httpClient;

    public function __construct(GuzzleHttp\Client $httpClient = null)
    {
        if (is_null($httpClient)) {
            $this->httpClient = new GuzzleHttp\Client();
        } else {
            $this->httpClient = $httpClient;
        }
    }

    public function get(string $path, ?string $host = null, array $headers = [])
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        $res = $this->httpClient->get($host.$path, ['headers' => $headers]);

        return json_decode($res->getBody());
    }

    public function post(string $path, ?array $postData = null, ?string $host = null, array $headers = [])
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path, $postData);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        if (is_null($postData)) {
            $res = $this->httpClient->post($host.$path, ['headers' => array_merge(['content-type' => 'application/json'], $headers)]);
        } else {
            $res = $this->httpClient->post($host.$path, ['form_params' => $postData, 'headers' => array_merge(['content-type' => 'application/json'], $headers)]);
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
