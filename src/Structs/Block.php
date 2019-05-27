<?php


namespace Pinfort\wavesPHP\Structs;

/**
 * Class Block
 * @package Pinfort\wavesPHP\Structs
 */
class Block
{
    /**
     * @var integer Version of block.
     */
    public $version = 0;

    /**
     * @var integer Timestamp when block created.
     */
    public $timestamp = 0;

    /**
     * @var string Signature of parent block.
     */
    public $reference = '';

    /**
     * @var array Generation signature and base target.
     */
    public $nxtConsensus = [];

    /**
     * @var string Address of block generator.
     */
    public $generator = '';

    /**
     * @var string Signature for check block.
     */
    public $signature = '';

    /**
     * @var integer Size of block(byte).
     */
    public $blockSize = 0;

    /**
     * @var integer Number of transaction this block includes.
     */
    public $transactionCount = 0;

    /**
     * @var integer Sum of fee this block have.
     */
    public $fee = 0;

    /**
     * @var array Transactions in this block.
     */
    public $transactions = [];

    /**
     * @var integer Height of this block.
     */
    public $height = 0;

    /**
     * @var array Raw block data.
     */
    public $raw = [];
}
