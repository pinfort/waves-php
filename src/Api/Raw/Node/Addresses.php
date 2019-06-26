<?php

namespace Pinfort\wavesPHP\Api\Raw\Node;

use Pinfort\wavesPHP\Api\Raw\ApiBase;
use InvalidArgumentException;

/**
 * kick Address APIs.
 * @package Pinfort\wavesPHP\Api\Raw\Node
 * @access public
 * @author pinfort <ptg@nijitei.com>
 * @category Api
 */
class Addresses extends ApiBase
{
    /**
     * Fetch addresses in node.
     * @param int|null $fromIdx Slice addresses start index.
     * @param int|null $toIdx Slice addresses end index.
     * @throws InvalidArgumentException If either one of fromIndex or toIndex are not null, both are required.
     * @return array
     */
    public function fetchAddresses(int $fromIdx = null, int $toIdx = null): array
    {
        if (!is_null($fromIdx) and !is_null($toIdx)) {
            return $this->api->get("/addresses/seq/$fromIdx/$toIdx");
        }
        if (is_null($fromIdx) and is_null($toIdx)) {
            return $this->api->get('/addresses');
        }
        throw new InvalidArgumentException('FromIndex and toIndex wants each other. must not be null.');
    }

    /**
     * Create address in node.
     * @return array
     */
    public function createAddress(): array
    {
        return $this->api->post('/addresses');
    }

    /**
     * Read all data posted by an account.
     * @param string $address Address for fetch.
     * @return array
     */
    public function fetchAllDataByAddress(string $address): array
    {
        return $this->api->get("/addresses/data/$address");
    }

    /**
     * @param string $address Address for check balance.
     * @param int $confirmations Confirmation count for check balance.
     * @return int
     */
    public function fetchAccountBalance(string $address, int $confirmations = 0): int
    {
        if ($confirmations === 0) {
            return $this->api->get("/addresses/balance/$address")['balance'];
        } else {
            return $this->api->get("/addresses/balance/$address/$confirmations")['balance'];
        }
    }
}
