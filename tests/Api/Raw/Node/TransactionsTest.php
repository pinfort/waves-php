<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/26
 * Time: 12:43
 */

namespace Pinfort\wavesPHP\Tests\Api\Raw\Node;

use Pinfort\wavesPHP\Api\Raw\Node\Transactions;
use PHPUnit\Framework\TestCase;
use Pinfort\wavesPHP\Config\Config;
use Pinfort\wavesPHP\Tests\Http\Api;

class TransactionsTest extends TestCase
{

    /**
     * test for fetch by id
     * @return void
     */
    public function testFetchById(): void
    {
        $transaction = new Transactions(new Api());
        $actual = $transaction->fetchById('4cKgLraZdiyXvdJxwgDtqpqHvAi7qWsZjg2rT2EHN4Xs');
        $this->assertEquals($actual, Config::get('fakeResponses.GET')['/transactions/info/4cKgLraZdiyXvdJxwgDtqpqHvAi7qWsZjg2rT2EHN4Xs']);
    }
}
