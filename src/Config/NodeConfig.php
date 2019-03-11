<?php

namespace Pinfort\wavesPHP\Config;


class NodeConfig
{
    public static function setNode(string $node, string $chain, string $chain_id){
        Config::set('node.NODE', $node);
        ChainConfig::setChain($chain, $chain_id);
    }

    public static function getNode(){
        return Config::get('node.NODE');
    }
}
