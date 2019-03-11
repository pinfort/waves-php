<?php

namespace Pinfort\wavesPHP\Api;

class Transaction extends ApiBase
{
    public static function fetchById(string $id)
    {
        return self::get("/transactions/info/$id");
    }
}
