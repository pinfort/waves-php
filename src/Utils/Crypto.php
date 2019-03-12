<?php

namespace Pinfort\wavesPHP\Utils;

use Kornrunner\Keccak;

class Crypto
{
    public static function hashChain($str)
    {
        $hashedA = hex2bin(blake2b($str, 32));
        $hashedB = hex2bin(Keccak::hash($hashedA, 256));
        return $hashedB;
    }
}
