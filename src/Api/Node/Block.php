<?php

namespace Pinfort\wavesPHP\Api\Node;

use Pinfort\wavesPHP\Api\ApiBase;

/**
 * Kick block APIs.
 * @package Pinfort\wavesPHP\Api\Node
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class Block extends ApiBase
{
    /**
     * Fetch now height.
     * @return array
     */
    public function fetchHeight(): array
    {
        return $this->api->get('/blocks/height')['height'];
    }

    /**
     * Fetch last block.
     * @return array
     */
    public function fetchLastBlock(): array
    {
        return $this->api->get('/blocks/last');
    }

    /**
     * Fetch block by height.
     * @param int $height Height to fetch.
     * @return array
     */
    public function fetchByHeight(int $height): array
    {
        return $this->api->get("/blocks/at/$height");
    }
}
