<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/05/29
 * Time: 20:41
 */

namespace Pinfort\wavesPHP\Api;

use Pinfort\wavesPHP\Api\Raw\Node\Addresses as RawAddresses;
use Pinfort\wavesPHP\Http\ApiInterface;

/**
 * Class Addresses
 * Object based API wrapper. Use under Pinfort\wavesPHP\Api\Raw\ if you need simple API.
 * @package Pinfort\wavesPHP\Api
 */
class Addresses
{
    /**
     * @var RawAddresses API functions class for Addresses.
     */
    private $api;

    /**
     * Addresses constructor.
     * @param ApiInterface|null $api API data fetcher class.
     */
    public function __construct(ApiInterface $api = null)
    {
        $this->api = (new RawAddresses($api));
    }
}
