<?php

namespace Pinfort\wavesPHP\Api;

use Pinfort\wavesPHP\Http\Api;
use Pinfort\wavesPHP\Http\ApiInterface;

class ApiBase
{
    protected $api;

    public function __construct(ApiInterface $api = null)
    {
        if (is_null($api)) {
            $this->api = (new Api());
        } else {
            $this->api = $api;
        }
    }
}