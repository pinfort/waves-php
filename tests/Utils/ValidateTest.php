<?php
/**
 * Created by PhpStorm.
 * User: pinfo
 * Date: 2019/03/27
 * Time: 13:12
 */

namespace Pinfort\wavesPHP\Tests\Utils;

use Pinfort\wavesPHP\Utils\Validate;
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{

    public function testValidateAddress()
    {
        $isValid = Validate::validateAddress('3PM1fmuMNZPntnHQLBaC8bKpJXUjuEmCRx5');
        $this->assertTrue($isValid);

        // Wrong address version
        $isValid = Validate::validateAddress('5AMY5qhf8KaRC9F6WSyTijRVhechPEiXgvM');
        $this->assertFalse($isValid);

        // Wrong chain id
        $isValid = Validate::validateAddress('3N8zrpaTWRrQGKyz57KCB8wzwdxy574Sw13');
        $this->assertFalse($isValid);

        // Wrong address length
        $isValid = Validate::validateAddress('BXdKx9C4v9ybZYsPyffW8WW3nMXSMZk5T84z');
        $this->assertFalse($isValid);

        // Wrong address checksum
        $isValid = Validate::validateAddress('3PM1fmuMNZPntnHQLBaC8bKpJMn4tRwhpgZ');
        $this->assertFalse($isValid);
    }
}
