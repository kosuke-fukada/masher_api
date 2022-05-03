<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use App\ValueObjects\User\ExpiresAt;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ExpiresAtTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = time() + 3600;
        $expiresAt = new ExpiresAt($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $expiresAt);
        $this->assertSame($expected, $expiresAt->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ExpiresAt(-1);
    }

    /**
     * @return void
     */
    public function testIsExpiredIn30Minutes(): void
    {
        $expected = time() + 3600;
        $expiresAt = new ExpiresAt($expected);
        $this->assertFalse($expiresAt->isExpiredIn30Minutes());

        $expected = time() + 600;
        $expiresAt = new ExpiresAt($expected);
        $this->assertTrue($expiresAt->isExpiredIn30Minutes());
    }
}
