<?php

namespace Pinfort\wavesPHP\Structs;

use Pinfort\wavesPHP\Api\Node\Addresses;
use Pinfort\wavesPHP\Api\Node\Assets;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Utils\Validate;
use StephenHill\Base58;
use Pinfort\wavesPHP\Utils\Crypto;

/**
 * Address struct.
 * @package Pinfort\wavesPHP\Structs
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Structs
 */
class Address
{
    /**
     * @var string Base58 encoded address.
     */
    public $address = '';

    /**
     * @var string Public key.
     */
    public $publicKey = '';

    /**
     * @var string Private key.
     */
    public $privateKey = '';

    /**
     * @var string Seed.
     */
    public $seed = '';

    /**
     * @var string Alias.
     */
    public $alias = '';

    /**
     * @var integer Nonce.
     */
    public $nonce = 0;

    /**
     * @var array Balances of assets.
     */
    public $balances = [];

    /**
     * @var Base58 Instance of Base58.
     */
    private $base58;

    /**
     * Address constructor.
     * @throws \Exception Failed make instance.
     */
    private function __construct()
    {
        $this->base58 = new Base58();
    }

    /**
     * Get address struct by Base58 encoded address.
     * @param string $address Base58 encoded address.
     * @return Address
     * @throws \InvalidArgumentException Invalid address.
     * @throws \Exception Failed make instance.
     */
    public static function getAddressByAddress(string $address): self
    {
        if (!Validate::validateAddress($address)) {
            throw new \InvalidArgumentException('Invalid address');
        }
        return (new self())->generate($address);
    }

    /**
     * Get address struct by seed of address.
     * @param string $seed Seed of address.
     * @param int $nonce Nonce of address.
     * @return Address
     * @throws \Exception Failed make instance.
     * @throws \InvalidArgumentException Failed validate nonce.
     */
    public static function getAddressBySeed(string $seed, int $nonce = 0): self
    {
        if ($nonce < 0 or $nonce > 4294967295) {
            throw new \InvalidArgumentException('Nonce must be between 0 and 4294967295');
        }

        $privKey = self::generatePrivateKeyFromSeedAndNonce($seed, $nonce);
        $pubKey = curve25519_public($privKey);

        $publicKey = (new Base58())->encode($pubKey);
        $privateKey = (new Base58())->encode($privKey);
        $address = self::generateAddressFromDecodedPublicKey($pubKey);

        return (new self())->generate($address, $publicKey, $privateKey, $seed, $nonce);
    }

    /**
     * Get address struct by public key of address.
     * @param string $publicKey Public key of address.
     * @return Address
     * @throws \Exception Failed make instance.
     */
    public static function getAddressByPublicKey(string $publicKey): self
    {
        $pubKey = (new Base58())->decode($publicKey);

        $address = self::generateAddressFromDecodedPublicKey($pubKey);

        return (new self())->generate($address, $publicKey);
    }

    /**
     * Get address struct by private key of address.
     * @param string $privateKey Base58 encoded Private key of address.
     * @return Address
     * @throws \Exception Failed generate address.
     * @throws \InvalidArgumentException Empty private key.
     */
    public static function getAddressByPrivateKey(string $privateKey): self
    {
        if (empty($privateKey)) {
            throw new \InvalidArgumentException('Private key must not be empty.');
        }
        $privKey = (new Base58())->decode($privateKey);
        $pubKey = curve25519_public($privKey);

        $publicKey = (new Base58())->encode($pubKey);
        $address = self::generateAddressFromDecodedPublicKey($pubKey);

        return (new self())->generate($address, $publicKey, $privateKey);
    }

    /**
     * @param int $nonce Nonce for generate Address.
     * @return Address
     * @throws \Exception Failed to generate Address.
     */
    public static function getAddressByRandom(int $nonce = 0): self
    {
        $seed = self::generateRandomSeed();

        return self::getAddressBySeed($seed, $nonce);
    }

    /**
     * Get address struct by alias of address.
     * @param string $alias Alias of address.
     * @return Address
     * @throws \Exception Failed make instance.
     */
    public static function getAddressByAlias(string $alias): self
    {
        // TODO: implement
        return (new self())->generate();
    }


    /**
     * Generate struct by some data.
     * @param string|null $address Base58 encoded address of address.
     * @param string|null $publicKey Base58 encoded public key of address.
     * @param string|null $privateKey Base58 encoded private key of address.
     * @param string|null $seed Seed of address.
     * @param int|null $nonce Nonce of Address.
     * @return Address
     */
    private function generate(?string $address = null, ?string $publicKey = null, ?string $privateKey = null, ?string $seed = null, ?int $nonce = null): self
    {
        $this->publicKey = $publicKey ?: '';
        $this->privateKey = $privateKey ?: '';
        $this->seed = $seed ?: '';
        $this->nonce = $nonce ?: 0;
        $this->address = $address ?: '';

        return $this;
    }

    /**
     * @return string Generated seed.
     * @throws \Exception Can not generate random bytes.
     */
    private static function generateRandomSeed(): string
    {
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
        return implode(' ', $words);
    }

    /**
     * @param string $seed Seed.
     * @param int $nonce Nonce.
     * @return string
     * @throws \Exception Failed generate private key.
     */
    private static function generatePrivateKeyFromSeedAndNonce(string $seed, int $nonce): string
    {
        $seedHash = Crypto::hashChain(pack('N', $nonce).$seed);
        $accountSeedHash = hash('sha256', $seedHash);
        return curve25519_private(hex2bin($accountSeedHash));
    }

    /**
     * @param string $DecodedPublicKey Base58 decoded public key.
     * @return string
     * @throws \Exception Failed to make hash.
     */
    private static function generateAddressFromDecodedPublicKey(string $DecodedPublicKey): string
    {
        $unHashedAddress = chr(1).Config::get('chain.CHAIN_ID').substr(Crypto::hashChain($DecodedPublicKey), 0, 20);
        $addressHash = substr(Crypto::hashChain($unHashedAddress), 0, 4);
        return (new Base58())->encode($unHashedAddress.$addressHash);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->address) {
            $balances_str_list = [];
            try {
                $balances = (new Assets())->fetchBalancesByAddress($this->address);
                foreach ($balances as $balance) {
                    if ($balance['balance'] > 0) {
                        $balances_str_list[] = '  '.$balance['assetId'].' ('.$balance['issueTransaction']['name'].') = '.$balance['balance'];
                    }
                }
            } catch (\Exception $e) {
                // Do nothing
            }
            $waves_balance = (new Addresses())->fetchAccountsBalance($this->address);
            return 'address = '.$this->address.PHP_EOL
                .'publicKey = '.$this->publicKey.PHP_EOL
                .'privateKey = '.$this->privateKey.PHP_EOL
                .'seed = '.$this->seed.PHP_EOL
                .'nonce = '.$this->nonce.PHP_EOL
                .'  Waves = '.$waves_balance.PHP_EOL
                .implode(PHP_EOL, $balances_str_list);
        }
    }
}
