<?php

namespace Pinfort\wavesPHP\Utils;

use Pinfort\wavesPHP\Config\Config;
use StephenHill\Base58;

/**
 * Class Validate
 * @package Pinfort\wavesPHP\Utils
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Utils
 */
class Validate
{
    /**
     * Validate address is valid.
     * @param string $address Address to validate.
     * @return bool
     * @throws \Exception Failed to validate.
     */
    public static function validateAddress(string $address): bool
    {
        $decodedAddr = (new Base58())->decode($address);
        if (substr($decodedAddr, 0, 1) != chr(Config::get('address.ADDRESS_VERSION'))) {
            // Wrong address version
            return false;
        }
        if (substr($decodedAddr, 1, 1) != Config::get('chain.CHAIN_ID')) {
            // Wrong chain id
            return false;
        }
        if (strlen($decodedAddr) != Config::get('address.ADDRESS_LENGTH')) {
            // Wrong address length
            return false;
        }
        if (substr($decodedAddr, Config::get('address.ADDRESS_CHECKSUM_LENGTH') * -1) != substr(Crypto::hashChain(substr($decodedAddr, 0, Config::get('address.ADDRESS_LENGTH') - Config::get('address.ADDRESS_CHECKSUM_LENGTH'))), 0, Config::get('address.ADDRESS_CHECKSUM_LENGTH'))) {
            // Wrong address checksum
            return false;
        }
        return true;
    }
}