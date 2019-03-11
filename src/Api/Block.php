<?php

namespace Pinfort\wavesPHP\Api;

class Block extends ApiBase
{
    public static function fetchHeight(): array
    {
        return self::get('/blocks/height')['height'];
    }

    public static function fetchLastBlock(): array
    {
        return self::get('/blocks/last');
    }

    public static function fetchByHeight(int $height): array
    {
        return self::get("/blocks/at/$height");
    }
}
