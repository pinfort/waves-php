<?php

namespace Pinfort\wavesPHP\Config;

class ChainConfig
{
    public static function setChain(string $chain, string $chainId)
    {
        if (is_null($chainId)) {
            switch (mb_strtolower($chain)) {
                case 'mainnet':
                case 'w':
                    $chain = 'mainnet';
                    $chainId = 'W';
                    break;
                case 'hacknet':
                case 'u':
                    $chain = 'hacknet';
                    $chainId = 'U';
                    break;
                default:
                    $chain = 'testnet';
                    $chainId = 'T';
                    break;
            }
        }
        Config::set('chain.CHAIN', $chain);
        Config::set('chain.CHAIN_ID', $chainId);
    }

}
