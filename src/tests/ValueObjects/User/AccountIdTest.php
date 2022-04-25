<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\User\AccountId;

class AccountIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 1;
        $accountId = new AccountId($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $accountId);
        $this->assertSame($expected, $accountId->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AccountId(-1);
    }
}
