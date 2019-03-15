<?php

namespace Pinfort\wavesPHP\Http;

use Pinfort\wavesPHP\Config\NodeConfig;
use Pinfort\wavesPHP\Config\Config;
use GuzzleHttp;

/**
 * [Http] Api
 *
 * This class DO HTTP access to Nodes or else.
 *
 * @package Pinfort\wavesPHP\Http
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Http
 */
class Api implements ApiInterface
{
    /**
     * keep http accessing class
     * @var GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Api constructor.
     * @param GuzzleHttp\Client|null $httpClient Input extended class if you want to mock. Default value is GuzzleHttp\Client.
     */
    public function __construct(?GuzzleHttp\Client $httpClient = null)
    {
        if (is_null($httpClient)) {
            $this->httpClient = new GuzzleHttp\Client();
        } else {
            $this->httpClient = $httpClient;
        }
    }

    /**
     * Do http access with verb GET.
     *
     * @param string $path Path to access. It must be start with slash.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return array
     */
    public function get(string $path, ?string $host = null, array $headers = []): array
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        $res = $this->httpClient->get(self::buildUrl($host, $path), ['headers' => $headers]);

        return json_decode($res->getBody());
    }

    /**
     * Do Http access with verb POST.
     *
     * @param string $path Path to access. It must be start with slash.
     * @param array|null $postData Input Data to post. Key-value style.
     * @param string|null $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param array $headers Set additional header. Key-value style.
     * @return array
     */
    public function post(string $path, ?array $postData = null, ?string $host = null, array $headers = []): array
    {
        $isOnline = Config::get('general.ONLINE');
        if (!$isOnline) {
            return self::makeOfflineTx($path, $postData);
        }
        if (is_null($host)) {
            $host = NodeConfig::getNode();
        }

        if (is_null($postData)) {
            $res = $this->httpClient->post(self::buildUrl($host, $path), ['headers' => array_merge(['content-type' => 'application/json'], $headers)]);
        } else {
            $res = $this->httpClient->post(self::buildUrl($host, $path), ['form_params' => $postData, 'headers' => array_merge(['content-type' => 'application/json'], $headers)]);
        }

        return json_decode($res->getBody());
    }

    /**
     * Make offlineTx Array. It includes ['api-type'], ['api-endpoint'], ['api-data']
     *
     * @param string $path Path to access. It must be start with slash.
     * @param array|null $postData Input Data to post. Key-value style.
     * @return array
     */
    private static function makeOfflineTx(string $path, ?array $postData = null): array
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

    /**
     * Build url from host and path.
     * @param string $host If you want to access other host. Default value is node.NODE in config. It must be start with http.
     * @param string $path Path to access. It should be start with slash.
     * @return string
     */
    private static function buildUrl(string $host, string $path): string
    {
        if (strpos($path, '/') === 0) {
            $path = '/'.$path;
        }
        return $host.$path;
    }
}
