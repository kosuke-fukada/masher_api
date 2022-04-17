<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use App\ValueObjects\User\UserId;
use InvalidArgumentException;
use Tests\TestCase;

class UserIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 1;
        $userId = new UserId($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $userId);
        $this->assertSame($expected, $userId->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new UserId(-1);
    }
}
