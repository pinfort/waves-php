<?php

namespace Pinfort\wavesPHP\Config;

/**
 * Specialized class for configuration about chain.
 * @package Pinfort\wavesPHP\Config
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Config
 */
class ChainConfig
{
    /**
     * Set chain config.
     * @param string $chain Chain name.
     * @param string $chainId Chain id (1 character).
     * @return void
     */
    public static function setChain(string $chain, string $chainId = null): void
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
