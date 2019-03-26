<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/26
 * Time: 13:49
 */

namespace Pinfort\wavesPHP\Tests\Utils;

use Pinfort\wavesPHP\Utils\Crypto;
use PHPUnit\Framework\TestCase;

class CryptoTest extends TestCase
{

    /**
     * test for hash chain
     */
    public function testHashChain()
    {
        $hashChain = Crypto::hashChain('test');
        $this->assertEquals(hex2bin('ffbdb7ff7b552b9a8c3daef11734a7f85d5c46984b874947f744991445406713'), $hashChain);

        $hashChain = Crypto::hashChain('this is test string');
        $this->assertEquals(hex2bin('be978c54dc20408e5351c95cc777a6519f32e77efb7fcf2f020ba669b6a5e31f'), $hashChain);
    }
}
