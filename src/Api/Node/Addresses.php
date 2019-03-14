<?php

namespace Pinfort\wavesPHP\Api\Node;

use Pinfort\wavesPHP\Api\ApiBase;

class Addresses extends ApiBase
{
    public function fetchAddresses(?int $fromIdx = null, ?int $toIdx = null)
    {
        if (!is_null($fromIdx) and !is_null($toIdx)) {
            return $this->api->get("/address/seq/$fromIdx/$toIdx");
        }
        return $this->api->get('/addresses');
    }

    public function createAddress()
    {
        return $this->api->post('/addresses');
    }

    public function verifySignatureByAddress(string $address, array $data)
    {
        return $this->api->post("/addresses/verify/$address", $data);
    }

    public function fetchAllDataByAddress(string $address)
    {
        return $this->api->post("/addresses/data/$address");
    }
}
