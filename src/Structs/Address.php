<?php

namespace Pinfort\wavesPHP\Structs;

use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Utils\Validate;
use StephenHill\Base58;
use Pinfort\wavesPHP\Utils\Crypto;

class Address
{
    public $address = '';
    public $publicKey = '';
    public $privateKey = '';
    public $seed = '';
    public $alias = '';
    public $nonce = 0;
    public $balances;
    private $base58;

    private function __construct()
    {
        $this->base58 = new Base58();
    }

    public static function getAddressByAddress(string $address): self
    {
        if (!Validate::validateAddress($address)) {
            throw new \InvalidArgumentException('Invalid address');
        }
        $obj = new self();
        $obj->address = $address;
        return $obj;
    }

    public static function getAddressBySeed(string $seed, int $nonce = 0): self
    {
        if ($nonce < 0 or $nonce > 4294967295) {
            throw new \InvalidArgumentException('Nonce must be between 0 and 4294967295');
        }
        return (new self())->generate(null, null, $seed, $nonce);
    }

    public static function getAddressByPublickey(string $publicKey): self
    {
        return (new self())->generate($publicKey);
    }

    public static function getAddressByPrivateKey(string $privateKey): self
    {
        return (new self())->generate(null, $privateKey);
    }

    public static function getAddressByAlias(string $alias): self
    {
        // WIP
    }

    public static function getAddressByNonce(int $nonce): self
    {
        return (new self())->generate(null, null, null, $nonce);
    }

    private function generate(string $publicKey = '', string $privateKey = '', string $seed = '', int $nonce = 0)
    {
        $this->seed = $seed;
        $this->nonce = $nonce;

        if (empty($publicKey) and empty($privateKey) and empty($seed)) {
            $wordCount = 2048;
            $words = [];
            $wordList = Config::get('address.WORD_LIST');
            for ($count = 0; $count < 5; $count++) {
                $seedNumber = hexdec(bin2hex(random_bytes(4)));
                $word1 = $seedNumber % $wordCount;
                $word2 = (floor($seedNumber / $wordCount) >> 0 + $word1) % $wordCount;
                $word3 = ((floor((floor($seedNumber / $wordCount) >> 0) / $wordCount) >> 0) + $word2) % $wordCount;
                $words[] = $wordList[$word1];
                $words[] = $wordList[$word2];
                $words[] = $wordList[$word3];
            }
            $this->seed = implode(' ', $words);
        }

        if (!empty($publicKey)) {
            $pubKey = $this->base58->decode($publicKey);
            $privKey = '';
        } else {
            $seedHash = Crypto::hashChain(pack('N', $nonce).$seed);
            $accountSeedHash = hash('sha256', $seedHash);
            if (empty($privateKey)) {
                $privKey = curve25519_private(hex2bin($accountSeedHash));
            } else {
                $privKey = $this->base58->decode($privateKey);
            }
            $pubKey = curve25519_public($privKey);
        }
        $unHashedAddress = chr(1).Config::get('chain.CHAIN_ID').substr(Crypto::hashChain($pubKey), 0, 20);
        $addressHash = substr(Crypto::hashChain($unHashedAddress), 0, 4);
        $this->address = $this->base58->encode($unHashedAddress.$addressHash);
        $this->publicKey = $this->base58->encode($pubKey);
        if (!empty($privKey)) {
            $this->privateKey = $this->base58->encode($privKey);
        }

        return $this;
    }

}
