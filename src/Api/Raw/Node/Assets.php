<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/05/25
 * Time: 0:21
 */

namespace Pinfort\wavesPHP\Api\Raw\Node;

use Pinfort\wavesPHP\Api\Raw\ApiBase;

/**
 * Kick assets APIs.
 * @package Pinfort\wavesPHP\Api\Raw\Node
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class Assets extends ApiBase
{
    /**
     * Fetch asset balances by address.
     * @param string $address Address for check balances.
     * @return array
     */
    public function fetchBalancesByAddress(string $address): array
    {
        return $this->api->get("/assets/balance/$address")['balances'];
    }

    /**
     * Fetch asset balance by address and asset id.
     * @param string $address Address for check balance.
     * @param string $assetId Asset id for check balance.
     * @return int
     */
    public function fetchSpecifiedAssetBalanceByAddress(string $address, string $assetId): int
    {
        return $this->api->get("/assets/balance/$address/$assetId")['balance'];
    }
}
