<?php

namespace Pinfort\wavesPHP\Api\Raw\Node;

use Pinfort\wavesPHP\Api\Raw\ApiBase;

/**
 * Kick transactions APIs.
 * @package Pinfort\wavesPHP\Api\Raw\Node
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class Transactions extends ApiBase
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
