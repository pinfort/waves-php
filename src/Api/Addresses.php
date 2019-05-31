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
use Pinfort\wavesPHP\Structs\Address;

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

    /**
     * @param int|null $fromIdx The start of index for address to fetch.
     * @param int|null $toIdx The end of index for address to fetch.
     * @return array List of object 'Address'.
     * @throws \InvalidArgumentException If either one of fromIndex or toIndex are not null, both are required.
     * @throws  \Exception Failed make instance of Base58.
     */
    public function fetchAddresses(int $fromIdx = null, int $toIdx = null): array
    {
        $struct_addresses = [];
        $response = $this->api->fetchAddresses($fromIdx, $toIdx);
        foreach ($response as $txt_address) {
            $struct_addresses[] = Address::getAddressByAddress($txt_address);
        }
        return $struct_addresses;
    }
}
