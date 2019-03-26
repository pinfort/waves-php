<?php

namespace Pinfort\wavesPHP\Utils;

use kornrunner\Keccak;

/**
 * Class Crypto
 * @package Pinfort\wavesPHP\Utils
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Utils
 */
class Crypto
{
    /**
     * Get hashed string.
     * @param string $str String to hash.
     * @return string
     * @throws \Exception Failed to get hash.
     */
    public static function hashChain(string $str): string
    {
        $hashedA = hex2bin(blake2b($str, 32));
        $hashedB = hex2bin(Keccak::hash($hashedA, 256));
        return $hashedB;
    }
}
