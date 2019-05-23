<?php


namespace Pinfort\wavesPHP\Structs;

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
            // TODO: write status function
        }
    }
}
