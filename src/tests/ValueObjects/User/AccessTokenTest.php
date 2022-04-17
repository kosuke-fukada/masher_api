<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\Foundation\StringValueObject;

class AccessTokenTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_access-token';
        $accessToken = new AccessToken($expected);
        $this->assertInstanceOf(StringValueObject::class, $accessToken);
        $this->assertSame($expected, (string)$accessToken);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AccessToken('');
    }

    /**
     * @return void
     */
    public function testInvalidCharacters(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AccessToken('あああ');
    }
}
