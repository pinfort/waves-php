<?php

namespace Pinfort\wavesPHP\Api\Node;

use Pinfort\wavesPHP\Api\ApiBase;

class Transaction extends ApiBase
{
    public function fetchById(string $transactionId)
    {
        return $this->api->get("/transactions/info/$transactionId");
    }
}
