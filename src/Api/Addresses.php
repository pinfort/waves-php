<?php

namespace Pinfort\wavesPHP\Api;

class Addresses extends ApiBase
{
    public static function fetchAddresses(?int $fromIdx = null, ?int $toIdx = null)
    {
        if (!is_null($fromIdx) and !is_null($toIdx)) {
            return self::get("/address/seq/$fromIdx/$toIdx");
        }
        return self::get('/addresses');
    }

    public static function createAddress()
    {
        return self::post('/addresses');
    }

    public static function verifySignatureByAddress(string $address, array $data)
    {
        return self::post("/addresses/verify/$address", $data);
    }

    public static function fetchAllDataByAddress(string $address)
    {
        return self::post("/addresses/data/$address");
    }
}
