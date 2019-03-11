<?php

namespace Pinfort\wavesPHP\Structs;

use Pinfort\wavesPHP\Config\Config;
use StephenHill\Base58;

class Address
{
    public $address;
    public $publicKey;
    public $privateKey;
    public $seed;
    public $alias;
    public $nonce;
    public $balances;

    private function __construct()
    {
    }

    public static function getAddressByAddress()
    {
    }

    private function generate(string $publicKey = '', string $privateKey = '', string $seed = '', int $nonce = 0)
    {
        $this->seed = $seed;
        $this->nonce = $nonce;

        if (empty($privateKey) and empty($privateKey) and empty($seed)) {
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
            $pubKey = (new Base58())->decode($publicKey);
            $privKey = '';
        } else {

        }
    }

}