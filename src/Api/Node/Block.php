<?php

namespace Pinfort\wavesPHP\Api\Node;

use Pinfort\wavesPHP\Api\ApiBase;

class Block extends ApiBase
{
    public function fetchHeight(): array
    {
        return $this->api->get('/blocks/height')['height'];
    }

    public function fetchLastBlock(): array
    {
        return $this->api->get('/blocks/last');
    }

    public function fetchByHeight(int $height): array
    {
        return $this->api->get("/blocks/at/$height");
    }
}
