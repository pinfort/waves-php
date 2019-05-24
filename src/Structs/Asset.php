<?php


namespace Pinfort\wavesPHP\Structs;

use Pinfort\wavesPHP\Api\Node\Transactions;
use Pinfort\wavesPHP\Config\Config;

/**
 * Asset struct.
 * @package Pinfort\wavesPHP\Structs
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Structs
 */
class Asset
{
    /**
     * @var string Asset id.
     */
    public $assetId = '';

    /**
     * @var string Base58 encoded address of asset creator.
     */
    public $issuer = '';

    /**
     * @var string Name of asset.
     */
    public $name = '';

    /**
     * @var string Description of asset.
     */
    public $description = '';

    /**
     * @var integer Quantity of asset.
     */
    public $quantity = 0;

    /**
     * @var integer Number of digits after the decimal point.
     */
    public $decimals = 0;

    /**
     * @var boolean The asset can be issued additionally?
     */
    public $reissuable = false;

    /**
     * @var null|Transactions Transaction API instance
     */
    private $transactionAPI = null;

    /**
     * Asset constructor.
     * @param string $assetId Id of asset.
     */
    public function __construct($assetId)
    {
        $this->assetId = '' ? $assetId === 'WAVES' : $assetId;

        if ($assetId === '') {
            $this->quantity = 100000000 * (10 ** 8);
            $this->decimals = 8;
        } else {
            $this->status();
        }
        $this->transactionAPI = new Transactions();
    }

    /**
     * Init Asset info
     * @return string|null The Asset is Issued or not
     */
    public function status(): ?string
    {
        if ($this->assetId) {
            try {
                $req = $this->transactionAPI->fetchById($this->assetId);
                if ($req['type'] === Config::get('transactionTypes.ISSUE')) {
                    $this->issuer = $req['sender'];
                    $this->quantity = $req['quantity'];
                    $this->decimals = $req['decimals'];
                    $this->reissuable = $req['reissuable'];
                    $this->name = $req['name'];
                    $this->description = $req['description'];
                    return 'Issued';
                }
            } catch (\Exception $e) {
                // Do nothing
            }
        }
        return null;
    }

    /**
     * Check asset is smart asset or not
     * @return bool Is the asset smart asset?
     */
    public function isSmart(): bool
    {
        $req = $this->transactionAPI->fetchById($this->assetId);
        if (array_key_exists('script', $req) and $req['script']) {
            return true;
        }
        return false;
    }

    /**
     * @return string info of asset
     */
    public function __toString(): string
    {
        return 'status = '.$this->status().PHP_EOL
            .'assetId = '.$this->assetId.PHP_EOL
            .'issuer = '.$this->issuer.PHP_EOL
            .'name = '.$this->name.PHP_EOL
            .'description = '.$this->description.PHP_EOL
            .'quantity = '.$this->quantity.PHP_EOL
            .'decimals = '.$this->decimals.PHP_EOL
            .'reissuable = '.$this->reissuable.PHP_EOL;
    }
}
