<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/05/29
 * Time: 20:41
 */

namespace Pinfort\wavesPHP\Api\Node;

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
        $structAddresses = [];
        $response = $this->api->fetchAddresses($fromIdx, $toIdx);
        foreach ($response as $txtAddress) {
            $structAddresses[] = Address::getAddressByAddress($txtAddress);
        }
        return $structAddresses;
    }

    /**
     * @return Address Created address.
     * @throws \Exception Failed make instance of Base58.
     */
    public function createAddress(): Address
    {
        $response = $this->api->createAddress();
        return Address::getAddressByAddress($response['address']);
    }

    /**
     * @param Address $address Address for check.
     * @param int $confirmations Check balance only over x confirmations.
     * @return int balance
     */
    public function fetchAccountBalance(Address $address, int $confirmations = 0): int
    {
        return $this->api->fetchAccountBalance($address->address, $confirmations);
    }
}
