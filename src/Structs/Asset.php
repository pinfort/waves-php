<?php


namespace Pinfort\wavesPHP\Structs;

use Pinfort\wavesPHP\Api\Node\Transactions;

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
    public $reIssuable = false;

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
                if ($req['type'] === 3) {
                    $this->issuer = $req['sender'];
                    $this->quantity = $req['quantity'];
                    $this->decimals = $req['decimals'];
                    $this->reIssuable = $req['reissuable'];
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
}
