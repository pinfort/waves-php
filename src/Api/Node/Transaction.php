<?php

namespace Pinfort\wavesPHP\Api\Node;

use Pinfort\wavesPHP\Api\ApiBase;

/**
 * Kick transaction APIs.
 * @package Pinfort\wavesPHP\Api\Node
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class Transaction extends ApiBase
{
    /**
     * Fetch transaction data from API by id.
     * @param string $transactionId Transaction id to fetch.
     * @return array
     */
    public function fetchById(string $transactionId): array
    {
        return $this->api->get("/transactions/info/$transactionId");
    }
}
