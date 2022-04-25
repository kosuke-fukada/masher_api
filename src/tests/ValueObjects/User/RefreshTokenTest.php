<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\User\RefreshToken;

class RefreshTokenTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_refresh-token';
        $refreshToken = new RefreshToken($expected);
        $this->assertSame($expected, (string)$refreshToken);
    }

    /**
     * @return void
     */
    public function testInvalidCharacters(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RefreshToken('あああ');
    }
}
