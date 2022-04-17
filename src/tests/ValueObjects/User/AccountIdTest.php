<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\Foundation\StringValueObject;

class AccountIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_id.';
        $accountId = new AccountId($expected);
        $this->assertInstanceOf(StringValueObject::class, $accountId);
        $this->assertSame($expected, (string)$accountId);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AccountId('');
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AccountId('あああ');
    }
}
