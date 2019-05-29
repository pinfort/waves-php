<?php

namespace Pinfort\wavesPHP\Api\Raw;

use Pinfort\wavesPHP\Http\Api;
use Pinfort\wavesPHP\Http\ApiInterface;

/**
 * Api base class
 * @package Pinfort\wavesPHP\Api\Raw
 * @access protected
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class ApiBase
{
    /**
     * @var ApiInterface Save api instance.
     */
    protected $api;

    /**
     * ApiBase constructor.
     * @param ApiInterface|null $api Input ApiInterface implemented instance if you need mock. Default class is \Pinfort\wavesPHP\Http\Api.
     */
    public function __construct(ApiInterface $api = null)
    {
        if (is_null($api)) {
            $this->api = (new Api());
        } else {
            $this->api = $api;
        }
    }
}