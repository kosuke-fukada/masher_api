<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\Foundation\StringValueObject;
use App\ValueObjects\User\RememberToken;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\StrGenerator;

class RememberTokenTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = StrGenerator::generateRandomString(RememberToken::MAX_LENGTH);
        $rememberToken = new RememberToken($expected);
        $this->assertInstanceOf(StringValueObject::class, $rememberToken);
        $this->assertSame($expected, (string)$rememberToken);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RememberToken('');
    }

    /**
     * @return void
     */
    public function testMaxLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RememberToken(StrGenerator::generateRandomString(RememberToken::MAX_LENGTH + 1));
    }
}
